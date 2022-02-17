@extends('lat::layouts.backend')

@section('pageHeader')
    <x-admintools-page-title icon="check-square" :title="__('laraconsent::admin.create-page-title')" />
@endsection


@section('metaTitle',__('laraconsent::admin.create-page-title'))

@section('content')
    @component('vendor.ekoukltd.laraconsent.consent-options.'.config('laravel-admin-tools.css_format').'.widgets._createForm',['consentOption'=>$consentOption])@endcomponent
@endsection

