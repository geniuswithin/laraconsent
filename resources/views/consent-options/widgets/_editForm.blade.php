@if($consentOption->usersViewedThisVersion)
    <div class="alert alert-danger">
        <p  style="margin: 5px">
            {{trans_choice('laraconsent::admin.users-accepted', $consentOption->usersViewedThisVersion,['count'=>$consentOption->usersViewedThisVersion])}} <br/>
            If you save a new version will be created. You may either:<br><strong>Only apply to new users  OR require all users to accept the new terms.</strong></p>
    </div>
@else
    <div class="alert alert-success">
        <p style="margin: 5px">{{ __('laraconsent::admin.editable-consent') }}</p>
    </div>
@endif
<form method="POST" action="{{route(config('laraconsent.routes.admin.prefix').'.update',$consentOption)}}" id="frmConsentOption">
    @csrf
    @method('patch')
    <input type="hidden" value="{{$consentOption->key}}" name="key">

    <div class="row">
        <div class="col">
            @component('laraconsent::components.inputs.text', [
                 'name' => 'title',
                 'id' => 'title',
                 'label' => __('Title'),
                 'placeholder' => 'Form Title',
                 'value' => $consentOption->title  ?? old('title'),
                 'required' => 'required'
            ])@endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col">
            @component('laraconsent::components.inputs.text', [
                'name' => 'label',
                'id' => 'label',
                'label' => __('Label for checkbox'),
                'placeholder' => 'eg. Tick here to accept the terms and conditions',
                'value' => $consentOption->label  ?? old('label'),
                'required' => 'required'
           ])@endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col">
            @component('laraconsent::components.inputs.text', [
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
            @component('laraconsent::components.inputs.toggle_inline',[
                             'name'=>'enabled',
                             'id'=>'enabled',
                             'groupClass'=>'toggleConsentStatus',
                             'consentOption'=>$consentOption->id,
                             'colour'=>$consentOption->enabled?'success':'light',
                             'url'=>route(config('laraconsent.routes.admin.prefix').".toggle",['consentOption'=>$consentOption]),
                             'label'=>__("Enable this consent form"),
                             'checked'=>$consentOption->enabled ?? old('enabled'),
                             'left'=>true
                  ])@endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col">
            @component('laraconsent::components.inputs.toggle_inline',[
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
            @component('laraconsent::components.inputs.toggle_inline',[
                                    'name'=>'force_user_update',
                                    'id'=>'force_user_update',
                                    'label'=>__("Require all users to re-confirm after this update"),
                                    'checked'=>old('force_user_update')??true,
                                    'left'=>true
                         ])@endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col">
            @component('laraconsent::components.inputs.select',[
                              'name'=>'models[]',
                              'id'=>'models',
                              'class'=>'js-select2',
                              'multiple'=>true,
                              'label'=>__("Models"),
                              'selected'=>$consentOption->models ?? old('models'),
                              'options'=>$consentOption->getAllUserTypes()
                   ])@endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col">
            @component('laraconsent::components.inputs.date_picker',[
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
            @component('laraconsent::components.inputs.textarea',[
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
        <div class="col text-right">
            <input type="submit" value="{{trans_choice('laraconsent::admin.save-btn',$consentOption->usersViewedThisVersion,['version'=>$consentOption->nextVersionNumber])}}" class="btn btn-lg btn-primary">
        </div>
    </div>
</form>

@push('scripts')
    <script>
        jQuery(function () {
            LaraConsent.helpers(['select2','statusToggles','flatpickr']);
            @if(config('laraconsent.editor'))
            LaraConsent.helpers(['{{config('laraconsent.editor')}}']);
            @endif
        });
    </script>
@endpush
