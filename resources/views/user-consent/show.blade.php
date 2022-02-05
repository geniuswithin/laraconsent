@extends('lat::layouts.backend')

@section('pageHeader',__('laraconsent::user.show-page-title'))
@section('metaTitle',__('laraconsent::user.show-page-title'))

@section('content')
    @component('vendor.ekoukltd.laraconsent.user-consent.'.config('laraconsent.css_format').'.widgets.my_consents',['consentOptions'=>$consentOptions])@endcomponent
@endsection

