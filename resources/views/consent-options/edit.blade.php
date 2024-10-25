@extends('lat::layouts.backend')

@section('pageHeader')
    <x-admintools-page-title icon="check-square" :title="__('laraconsent::admin.edit-page-title',['title'=>$consentOption->title,'version'=>$consentOption->version])" />
@endsection


@section('metaTitle',__('laraconsent::admin.edit-page-title',['title'=>$consentOption->title,'version'=>$consentOption->version]))

@section('content')
    @component('vendor.ekoukltd.laraconsent.consent-options.'.config('laravel-admin-tools.css_format').'.widgets._editForm',['consentOption'=>$consentOption])@endcomponent
@endsection

