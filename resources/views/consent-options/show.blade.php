@extends('lat::layouts.backend')

@section('pageHeader')
    <x-admintools-page-title icon="check-square" :title="__('laraconsent::admin.show-page-title',['title'=>$consentOption])" />
@endsection

@section('metaTitle',__('laraconsent::admin.show-page-title',['title'=>$consentOption]))


@section('content')
    <div class="d-grid gap-2 col-4 mb-0 ms-auto">
        @component('vendor.ekoukltd.laraconsent.consent-options.'.config('laravel-admin-tools.css_format').'.widgets._versionPicker',['consentOption'=>$consentOption])@endcomponent
    </div>

    @component('vendor.ekoukltd.laraconsent.consent-options.'.config('laravel-admin-tools.css_format').'.widgets._viewAdmin',['consentOption'=>$consentOption])@endcomponent
@endsection