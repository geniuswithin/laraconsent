<form method="POST" action="{{route(config('laraconsent.routes.admin.prefix').'.store')}}">
    @csrf

    <x-admintools-block title="{{__('New Contract')}}">

        @component('laraconsent::components.'.config('laravel-admin-tools.css_format').'.inputs.text', [
                 'name' => 'key',
                 'id' => 'key',
                 'label' => 'Key',
                 'placeholder' => 'Unique Key',
                 'class'=>'js-slugify',
                 'value' => $consentOption->key  ?? old('key'),
                 'required' => 'required'
            ])
        @endcomponent

        @component('laraconsent::components.'.config('laravel-admin-tools.css_format').'.inputs.text', [
             'name' => 'title',
             'id' => 'title',
             'label' => __('Title'),
             'placeholder' => 'Enter Title',
             'value' => $consentOption->title  ?? old('title'),
             'required' => 'required'
        ])
        @endcomponent

        @component('laraconsent::components.'.config('laravel-admin-tools.css_format').'.inputs.text', [
            'name' => 'label',
            'id' => 'label',
            'label' => __('Label for checkbox'),
            'placeholder' => 'Enter Label',
            'value' => $consentOption->label  ?? old('label'),
            'required' => 'required'
       ])
        @endcomponent

        @component('laraconsent::components.'.config('laravel-admin-tools.css_format').'.inputs.text', [
            'name' => 'sort_order',
            'id' => 'sort_order',
            'label' => __('Sort Order'),
          'type'=>'number',
            'placeholder' => '1',
            'value' => $consentOption->sort_order  ?? old('sort_order'),
            'required' => 'required'
       ])
        @endcomponent

        @component('laraconsent::components.'.config('laravel-admin-tools.css_format').'.inputs.toggle_inline',[
                         'name'=>'enabled',
                         'id'=>'enabled',
                         'label'=>__("Enable this consent form"),
                         'checked'=>$consentOption->enabled ?? old('enabled'),
                         'left'=>true
        ])
        @endcomponent

        @component('laraconsent::components.'.config('laravel-admin-tools.css_format').'.inputs.toggle_inline',[
                         'name'=>'is_mandatory',
                         'id'=>'is_mandatory',
                         'label'=>__("Is Mandatory"),
                         'checked'=>$consentOption->is_mandatory ?? old('is_mandatory'),
                         'left'=>true
        ])@endcomponent

        @component('laraconsent::components.'.config('laravel-admin-tools.css_format').'.inputs.select',[
                          'name'=>'models[]',
                          'id'=>'models',
                          'label'=>__("Models"),
                          'multiple'=>true,
                          'class'=>'js-select2',
                          'selected'=>$consentOption->models ?? old('models'),
                          'options'=>$consentOption->getAllUserTypes()
        ])
        @endcomponent

        @component('laraconsent::components.'.config('laravel-admin-tools.css_format').'.inputs.date_picker',[
            'name'=>'published_at',
            'label'=>__("Publish Date"),
            'required'=>true,
            'enableTime'=>true,
            'value'=>$consentOption->published_at ?? old('published_at')
        ])
        @endcomponent

        @component('laraconsent::components.'.config('laravel-admin-tools.css_format').'.inputs.textarea',[
                    'name' => 'text',
                    'id'=>'consentText',
                    'label'=>__('Option Text'),
                    'class'=>'js-'.config('laraconsent.editor'),
                    'required'=>true,
                    'value' => $consentOption->text ?? old('text')
                    ])
        @endcomponent

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </x-admintools-block>
    <div class="d-grid gap-2 col-12 mx-auto mb-4">
        <input type="submit" value="{{__('Save Consent Option')}}" class="btn btn-lg btn-success">
    </div>
</form>

@push('scripts')
    <script>
        jQuery(function () {
            LaraConsent.helpers(['slugifyInput', 'select2', 'flatpickr']);
            @if(config('laraconsent.editor'))
            //LaraConsent.helpers(['{{config('laraconsent.editor')}}']);
            @endif
        });
    </script>
@endpush
