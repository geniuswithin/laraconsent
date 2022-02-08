<?php

return [
    //Grouping of admin web routes
    'routes'     => [
        'admin' => [
            //Admin web routes should only be available to admins
            'prefix'     => 'consent-admin',
            'middleware' => ['web','auth']
        ],
        'user'  => [
            //User routes should be available to any logged in user
            'prefix'     => 'user-consent',
            'middleware' => ['web','auth']
        ],
    ],
    
    //enable middleware intercept
    //Disable this to use your own custom midddleware
    'middleware' => [
      'enable' => true,
    ],
    
    //User models that consent forms should be available to.
    'models'     => [
        'App\Models\User',
        'App\Models\Admin',
    ],
    
    //Which HTML Editor to use
    //Chooose from froala, summernote, ckeditor
    //Froala requires a licence key in .env MIX_FROALA_KEY=xxxxxx
    //Summernote doesn't work with bootstrap5.
    'editor'=>'ckeditor',
    
    //Whether to log when consent has been given
    //Probably only interested in logging the mandatory events
    //Will be saved to the default logging channel as Info message
    'logging'    => [
        'mandatory' => true,
        'optional'  => false,
    ],
    
    'print'=>[
            //Requires barryvdh/laravel-dompdf
            //composer install barryvdh/laravel-dompdf
            'pdf-driver'=>'dompdf'
    ],
    
    //send user an email with a copy of the consent after saving.
    'notify' => ['mail'],
    
    'email-template'=>'vendor.ekoukltd.laraconsent.layouts.email',
    
    'datatables'=>[
        'dom'=>[
            'bootstrap4'=>"<'row'<'col-sm-12 text-right'B>><'row'<'col-sm-12 col-md-6 text-left'f><'col-sm-12 col-md-6 text-right'i>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5 mb-3'l><'col-sm-12 col-md-7 mb-3'p>>",
            'bootstrap5'=>"<'row'<'col-sm-12 text-end'B>><'row'<'col-sm-12 col-md-6 text-start'f><'col-sm-12 col-md-6 text-end'i>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5 mb-3'l><'col-sm-12 col-md-7 mb-3'p>>",
            'tailwind'=>""
            ]
        
    ]
];