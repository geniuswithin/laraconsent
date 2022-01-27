// Helpers
export default class Helpers {

   static run(helpers, options = {}) {
       let allHelpers = {
           ckeditor: () => this.ckeditor(),
           flatpickr: () => this.flatpickr(),
           froala: ()=> this.froala(),
           initCSRF: ()=> this.initCSRF(),
           notify: (options)=> this.notify(options),
           select2: () => this.select2(),
           slugifyInput: () => this.slugifyInput(),
           slugify: () => this.slugify(),
           summernote: () => this.summernote(),
           versionPicker: () => this.versionPicker(),
           statusToggles: () => this.statusToggles(),
           toggleUserConsent: () => this.toggleUserConsent(),


       };

       if (helpers instanceof Array) {
           for (let index in helpers) {
               if (allHelpers[helpers[index]]) {
                   allHelpers[helpers[index]](options);
               }
           }
       } else {
           if (allHelpers[helpers]) {
               allHelpers[helpers](options);
           }
       }
   }

   static initCSRF()
   {
       jQuery.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
           }
       });
   }

   static versionPicker() {
       jQuery('.js-versionPicker:not(.js-versionPicker-enabled)').each((index, element) => {
           let el = jQuery(element);
           el.addClass('js-versionPicker-enabled');

           el.on('select2:select', function (e) {
               let url = jQuery(e.params.data.element).attr('data-show-consent-url');
               window.location.href = url;
           });
       });
   }

   static slugifyInput() {

       jQuery('.js-slugify:not(.js-slugify-enabled)').each((index, element) => {
           let el = jQuery(element);
           el.addClass('js-slugify-enabled');
           jQuery(element).on('keyup paste',function(){
               jQuery(this).val(jQuery(this).val().slugify("-"));
           });
       });
   }

    /*
  * Flatpickr
  * <input type="text" class="js-flatpickr form-control">
  */
    static flatpickr() {
        // Init Flatpickr (with .js-flatpickr class)
        jQuery('.js-flatpickr:not(.js-flatpickr-enabled)').each((index, element) => {
            let el = jQuery(element);
            el.addClass('js-flatpickr-enabled');
            flatpickr(el, {});
        });
    }

    /**
     * FROALA Editor - requires a licence
     * Add Key to .env under MIX_FROALA_KEY=xxxxxx
     * Helpers.run('froala');
     * <div class="js-froala">{{ $model->text }}</div>
     */
    static froala() {
        var key=process.env.MIX_FROALA_KEY;
        jQuery('.js-froala:not(.js-froala-enabled)').each((index, element) => {
            let id=jQuery(element).attr('id');
            jQuery(element).addClass('js-froala-enabled');

            new FroalaEditor('textarea#'+id,{
                key: key,
                initOnClick: true,
                wordPasteModal: false,
                wordPasteKeepFormatting: false,
                toolbarButtons: {
                    moreText: {
                        buttons: ['bold', 'italic', 'underline', 'fontSize', 'textColor', 'backgroundColor','clearFormatting'],
                        align: 'left',
                        buttonsVisible: 7
                    },
                    moreParagraph: {
                        buttons: ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify','formatUL','formatOL', 'paragraphFormat', 'paragraphStyle', 'outdent', 'indent'],
                        align: 'left',
                        buttonsVisible: 10
                    },
                    moreRich: {
                        buttons: ['insertLink','insertHR','html'],
                        align: 'left',
                        buttonsVisible: 5
                    },
                },
            });
        });
    }

    /**
     * Init Summernote open source - free editor
     * Helpers.run('summernote');
     * <div class="js-summernote">{{ $model->text }}</div>
     */
    static summernote() {

        // Init full text editor
        jQuery('.js-summernote:not(.js-summernote-enabled)').each((index, element) => {
            let el = jQuery(element);
            var id = el.attr('id');
            el.addClass('js-summernote-enabled').summernote({
                height: el.data('height') || 350,
                minHeight: el.data('min-height') || null,
                maxHeight: el.data('max-height') || null,
                spellCheck: true,
                fontNames: ['Tahoma'],
                fontName: 'Tahoma',
                fontNamesIgnoreCheck: ['Roboto','Helvetica Neue','Arial'],

            toolbar: [
                    ['cleaner',['cleaner']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']],
                ],
                cleaner:{
                    action: 'both',
                    newline: '<br>',
                    icon: '<i class="note-icon"><i class="far fa-file-word"></i> Paste From Word</i>',
                    keepHtml: false,
                    keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>'],
                    keepClasses: false,
                    badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'],
                    badAttributes: ['style', 'start'],
                    limitChars: false,
                    limitDisplay: 'both',
                    limitStop: false
                },

            });
        });

    }

    /*
     * Select2, for more examples you can check out https://github.com/select2/select2
     */
    static select2() {
        jQuery('.js-select2:not(.js-select2-enabled)').each((index, element) => {
            let el = jQuery(element);
            el.addClass('js-select2-enabled').select2({
                placeholder: el.data('placeholder') || false
            });
        });
    }

    static slugify()
    {
        String.prototype.slugify = function (separator = "-") {
            return this
                .toString()
                .normalize('NFD')                   // split an accented letter in the base letter and the acent
                .replace(/[\u0300-\u036f]/g, '')   // remove all previously split accents
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

        };
    }

    static toggleUserConsent()
    {
            jQuery(document).on('change','.js-toggle-consent', function (e) {
                let input = jQuery(this).find('input[type="checkbox"]');
                jQuery.ajax({
                    url: jQuery(this).data('url'),
                    method: "POST",
                    success: function (data) {
                        if (data.hasOwnProperty('success')) {
                            LaraConsent.helpers('notify', {type: data.colour, icon: 'fa fa-check mr-1', message: data.message});
                        }
                        if (data.hasOwnProperty('error')) {
                            //Undo Toggle
                            input.prop("checked", !input.prop("checked"));
                            LaraConsent.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: data.message});
                        }

                    },
                    error: function () {
                        input.prop("checked", !input.prop("checked"));
                        LaraConsent.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: "There was an error changing status"});
                    }
                });
            });

    }
    static statusToggles() {
        /**
         * Toggle Status button action on user tables
         */
        jQuery(document).on('click', '.toggleConsentStatus', function (e) {
            e.preventDefault();
            let button = jQuery(this);
            let input = button.find('input:checkbox');
            var url = input.data('url');
            input.prop("checked", !input.prop("checked"));
            button.toggleClass('custom-control-success custom-control-light');
            jQuery.ajax({
                url: url,
                method: "POST",
                success: function (data) {
                    if (data.hasOwnProperty('success')) {
                        console.log(data);
                        LaraConsent.helpers('notify', {type: data.colour, icon: 'fa fa-check mr-1', message: data.message});
                    }
                    if (data.hasOwnProperty('error')) {
                        //Undo Toggle
                        input.prop("checked", !input.prop("checked"));
                        button.toggleClass('custom-control-success custom-control-light');
                        LaraConsent.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: data.message});
                    }

                },
                error: function () {
                    input.prop("checked", !input.prop("checked"));
                    button.toggleClass('custom-control-success custom-control-light');
                    LaraConsent.helpers('notify', {type: 'danger', icon: 'fa fa-times mr-1', message: "There was an error changing status"});
                }
            });
        });

    }

    static notify(options = {}) {
            jQuery.notify({
                    icon: options.icon || '',
                    message: options.message,
                    url: options.url || ''
                },
                {
                    element: options.element || 'body',
                    type: options.type || 'info',
                    placement: {
                        from: options.from || 'top',
                        align: options.align || 'right'
                    },
                    allow_dismiss: (options.allow_dismiss === false) ? false : true,
                    newest_on_top: (options.newest_on_top === false) ? false : true,
                    showProgressbar: options.show_progress_bar ? true : false,
                    offset: options.offset || 20,
                    spacing: options.spacing || 10,
                    z_index: options.z_index || 1033,
                    delay: options.delay || 5000,
                    timer: options.timer || 1000,
                    animate: {
                        enter: options.animate_enter || 'animated fadeIn',
                        exit: options.animate_exit || 'animated fadeOutDown'
                    }
                });

    }
}
