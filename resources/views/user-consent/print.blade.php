@extends('vendor.ekoukltd.laraconsent.layouts.print')
@section('metaTitle',  __('laraconsent::user.print-meta-title') )
@section('description',__('laraconsent::user.print-description'))
@section('author',__('laraconsent::user.print-author'))

@section('content')
    @component('vendor.ekoukltd.laraconsent.user-consent.print.header')@endcomponent
    @component('vendor.ekoukltd.laraconsent.user-consent.print.footer')@endcomponent
    @component('vendor.ekoukltd.laraconsent.user-consent.'.config('laravel-admin-tools.css_format').'.widgets.my_consents',['consentOptions'=>$consentOptions])@endcomponent
@endsection

