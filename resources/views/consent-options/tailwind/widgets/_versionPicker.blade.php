@component('laraconsent::components.'.config('laraconsent.css_format').'.inputs.select',[
                              'name'=>'version',
                              'id'=>'versionPicker',
                              'class'=>'js-versionPicker',
                              'label'=>__("Other Versions"),
                              'showUrl'=>true,
                              'selected'=>[$consentOption->id],
                              'options'=>$consentOption->getAllVersionsForSelect()
                   ])@endcomponent


@push('scripts')
    <script>
        jQuery(function () {
            LaraConsent.helpers(['versionPicker']);
        });
    </script>
@endpush