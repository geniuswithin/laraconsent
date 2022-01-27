@extends('vendor.ekoukltd.layouts.print')
@section('metaTitle',  __('laraconsent::user.print-meta-title') )
@section('description',__('laraconsent::user.print-description'))
@section('author',__('laraconsent::user.print-author'))

@section('content')
    @component('vendor.ekoukltd.user-consent.widgets._printHeader')@endcomponent
    @component('vendor.ekoukltd.user-consent.widgets._printFooter')@endcomponent
    @component('vendor.ekoukltd.consent-options.widgets._viewUser',['consentOptions'=>$consentOptions])@endcomponent
@endsection

