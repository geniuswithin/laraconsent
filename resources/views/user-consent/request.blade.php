@extends('lat::layouts.backend')

@section('pageHeader',__('laraconsent::user.request-page-title'))
@section('metaTitle',__('laraconsent::user.request-page-title'))

@section('content')
    @component('vendor.ekoukltd.laraconsent.user-consent.'.config('laraconsent.css_format').'.widgets._form',['consentOptions'=>$consentOptions])@endcomponent
@endsection

