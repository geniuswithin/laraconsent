@extends('vendor.ekoukltd.laraconsent.layouts.print')
@section('metaTitle',  __('laraconsent::user.print-meta-title') )
@section('description',__('laraconsent::user.print-description'))
@section('author',__('laraconsent::user.print-author'))

@section('content')
    @component('vendor.ekoukltd.laraconsent.user-consent.widgets._printHeader')@endcomponent
    @component('vendor.ekoukltd.laraconsent.user-consent.widgets._printFooter')@endcomponent
    @component('vendor.ekoukltd.laraconsent.consent-options.widgets._viewUser',['consentOptions'=>$consentOptions])@endcomponent
@endsection

