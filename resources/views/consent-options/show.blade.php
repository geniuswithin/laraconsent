<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('laraconsent::admin.show-page-title',['title'=>$consentOption]) }}
        </h2>
            <div>
                @include('vendor.ekoukltd.consent-options.widgets._versionPicker')
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  @include('vendor.ekoukltd.consent-options.widgets._viewAdmin')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>



