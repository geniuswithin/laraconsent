@extends('lat::layouts.backend')

@section('pageHeader')
    <i class='fa fa-check-square'></i> {{__('laraconsent::admin.index-page-title')}}
@endsection

@section('metaTitle',__('laraconsent::admin.index-page-title'))

@section('content')
    @include('vendor.ekoukltd.laraconsent.consent-options.'.config('laraconsent.css_format').'.widgets._dataTable')
@endsection