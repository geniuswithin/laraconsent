<form method="POST" action="{{route(config('laraconsent.routes.admin.prefix').'.store')}}">
    @csrf
    <div class="row">
        <div class="col">

            @component('laraconsent::components.'.config('laraconsent.css_format').'.inputs.text', [
                     'name' => 'key',
                     'id' => 'key',
                     'label' => 'Key',
                     'placeholder' => 'Unique Key',
                     'class'=>'js-slugify',
                     'value' => $consentOption->key  ?? old('key'),
                     'required' => 'required'
                ])@endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col">
            @component('laraconsent::components.'.config('laraconsent.css_format').'.inputs.text', [
                 'name' => 'title',
                 'id' => 'title',
                 'label' => __('Title'),
                 'placeholder' => 'Enter Title',
                 'value' => $consentOption->title  ?? old('title'),
                 'required' => 'required'
            ])@endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col">
            @component('laraconsent::components.'.config('laraconsent.css_format').'.inputs.text', [
                'name' => 'label',
                'id' => 'label',
                'label' => __('Label for checkbox'),
                'placeholder' => 'Enter Label',
                'value' => $consentOption->label  ?? old('label'),
                'required' => 'required'
           ])@endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col">
            @component('laraconsent::components.'.config('laraconsent.css_format').'.inputs.text', [
                'name' => 'sort_order',
                'id' => 'sort_order',
                'label' => __('Sort Order'),
                'placeholder' => '1',
                'value' => $consentOption->sort_order  ?? old('sort_order'),
                'required' => 'required'
           ])@endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col">
            @component('laraconsent::components.'.config('laraconsent.css_format').'.inputs.toggle_inline',[
                             'name'=>'enabled',
                             'id'=>'enabled',
                             'label'=>__("Enable this consent form"),
                             'checked'=>$consentOption->enabled ?? old('enabled'),
                             'left'=>true
                  ])@endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col">
            @component('laraconsent::components.'.config('laraconsent.css_format').'.inputs.toggle_inline',[
                             'name'=>'is_mandatory',
                             'id'=>'is_mandatory',
                             'label'=>__("Is Mandatory"),
                             'checked'=>$consentOption->is_mandatory ?? old('is_mandatory'),
                             'left'=>true
                  ])@endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col">
            @component('laraconsent::components.'.config('laraconsent.css_format').'.inputs.select',[
                              'name'=>'models[]',
                              'id'=>'models',
                              'label'=>__("Models"),
                              'multiple'=>true,
                              'class'=>'js-select2',
                              'selected'=>$consentOption->models ?? old('models'),
                              'options'=>$consentOption->getAllUserTypes()
                   ])@endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col">
            @component('laraconsent::components.'.config('laraconsent.css_format').'.inputs.date_picker',[
                'name'=>'published_at',
                'label'=>__("Publish Date"),
                'required'=>true,
                'enableTime'=>true,
                'value'=>$consentOption->published_at ?? old('published_at')
            ])@endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col">
            @component('laraconsent::components.'.config('laraconsent.css_format').'.inputs.textarea',[
                        'name' => 'text',
                        'id'=>'laraConsentText',
                        'label'=>__('Option Text'),
                        'class'=>'js-'.config('laraconsent.editor'),
                        'required'=>true,
                        'value' => $consentOption->text ?? old('text')
                        ])
            @endcomponent
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <input type="submit" value="{{__('Save Consent Option')}}" class="btn btn-lg btn-primary">
        </div>
    </div>
</form>

@push('scripts')
    <script>
        jQuery(function () {
            LaraConsent.helpers(['slugifyInput','select2','flatpickr']);
            @if(config('laraconsent.editor'))
            LaraConsent.helpers(['{{config('laraconsent.editor')}}']);
            @endif
        });
    </script>
@endpush
