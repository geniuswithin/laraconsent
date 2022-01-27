<?php

return [
    //Grouping of admin web routes
    'routes'     => [
        'admin' => [
            //Admin web routes should only be available to admins
            'prefix'     => 'consent-admin',
            'middleware' => ['web']
        ],
        'user'  => [
            //User routes should be available to any logged in user
            'prefix'     => 'user-consent',
            'middleware' => ['web']
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
    //Chooose from froala, summernote, none
    //Froala requires a licence key in .env MIX_FROALA_KEY=xxxxxx
    'editor'=>'summernote',
    
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
    'email-template'=>'vendor.ekoukltd.layouts.email'
];