import 'bootstrap';
import 'popper.js';
import 'select2';
import 'plugins/bootstrap-notify.min'
import flatpikr from "flatpickr";

/** Datatables Dependencies **/
try {
    window.$ = window.jQuery = require('jquery');
    /**
     * Enable these options if you wish to exporting datatables to PDF, Excel or CSV
     */
    // require( 'jszip' );
    // require( 'pdfmake' );
    // require( 'datatables.net-buttons-bs4' );
    // require( 'datatables.net-buttons/js/buttons.colVis.js' );
    // require( 'datatables.net-buttons/js/buttons.flash.js' );
    // require( 'datatables.net-buttons/js/buttons.html5.js' );
    // require( 'datatables.net-buttons/js/buttons.print.js' );
    require( 'datatables.net-bs4' );
    require( 'datatables.net-scroller-bs4' );
    require( 'datatables.net-responsive-bs4' );


} catch (e) {}


/** Summernote Editor **/
import 'summernote/dist/summernote';

/**
 * Uncomment these lines for Froala Editor -> Requires a license
 */
// import FroalaEditor from 'froala-editor'
// window.FroalaEditor = FroalaEditor;

// Optional Froala Plugins
// require('froala-editor/js/plugins/align.min')
// require('froala-editor/js/plugins/word_paste.min')
// require('froala-editor/js/plugins/code_view.min')
// require('froala-editor/js/plugins/font_size.min')
// // require('froala-editor/js/plugins/image.min')
// // require('froala-editor/js/plugins/image_manager.min')
// // require('froala-editor/js/plugins/file.min')
// require('froala-editor/js/plugins/lists.min')
// require('froala-editor/js/plugins/colors.min')
// require('froala-editor/js/plugins/link.min')
