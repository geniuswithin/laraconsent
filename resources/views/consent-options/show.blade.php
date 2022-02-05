@extends('lat::layouts.backend')

@section('pageHeader',__('laraconsent::admin.show-page-title',['title'=>$consentOption]))
@section('metaTitle',__('laraconsent::admin.show-page-title',['title'=>$consentOption]))
@section('subHeader')

@endsection

@section('content')
    <div class="d-grid gap-2 col-4 mb-0 ms-auto">
        @component('vendor.ekoukltd.laraconsent.consent-options.'.config('laraconsent.css_format').'.widgets._versionPicker',['consentOption'=>$consentOption])@endcomponent
    </div>

    @component('vendor.ekoukltd.laraconsent.consent-options.'.config('laraconsent.css_format').'.widgets._viewAdmin',['consentOption'=>$consentOption])@endcomponent
@endsection