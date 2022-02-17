@extends('lat::layouts.backend')

@section('pageHeader')
    <x-admintools-page-title icon="check-square" :title="$pageTitle" />
@endsection


@section('metaTitle',__('laraconsent::admin.index-page-title'))

@section('content')
    @include('vendor.ekoukltd.laraconsent.consent-options.'.config('laravel-admin-tools.css_format').'.widgets._dataTable')
@endsection