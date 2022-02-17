@extends('lat::layouts.backend')

@section('pageHeader')
    <x-admintools-page-title icon="check-square" :title="__('laraconsent::user.show-page-title')" />
@endsection


@section('metaTitle',__('laraconsent::user.show-page-title'))

@section('content')
    @component('vendor.ekoukltd.laraconsent.user-consent.'.config('laravel-admin-tools.css_format').'.widgets.my_consents',['consentOptions'=>$consentOptions])@endcomponent
@endsection

