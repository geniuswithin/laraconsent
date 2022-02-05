<div class="form-group d-flex consent-toggle {{$model->is_mandatory?'mandatory':'optional'}} align-items-center justify-content-start @error('consent_option.'.$model->id) is-invalid @enderror">
    <div class="custom-control custom-switch custom-control-primary custom-control-lg d-flex justify-content-end" style="cursor: pointer">
        <input type="hidden" name="consent_option[{{$model->id}}]" value='0'>
        <input type="checkbox"
               class="custom-control-input"
               id="{{$model->key}}"
               name="consent_option[{{$model->id}}]"
               value='1'
                {{old('consent_option.'.$model->id)=="1"?'checked':''}}
                {{$model->is_mandatory?'required':''}}
        >
        <label class="custom-control-label "
               for="{{$model->key}}"
               style="cursor:pointer">{{$model->label??''}}
            @if($model->is_mandatory)
                &nbsp;<span class="text-danger">*</span>
            @endif
        </label>
    </div>
</div>