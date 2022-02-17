@extends('lat::layouts.backend')

@section('pageHeader')
    <x-admintools-page-title icon="check-square" :title="__('laraconsent::user.request-page-title')" />
@endsection

@section('metaTitle',__('laraconsent::user.request-page-title'))

@section('content')
    @component('vendor.ekoukltd.laraconsent.user-consent.'.config('laravel-admin-tools.css_format').'.widgets._form',['consentOptions'=>$consentOptions])@endcomponent
@endsection

