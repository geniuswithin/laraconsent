<div class="mb-4">
    <div class="form-check form-switch {{$model->is_mandatory?'mandatory':'optional'}} @error('consent_option.'.$model->id) is-invalid @enderror">
        <input class="form-check-input" type="checkbox" value="1" id="{{$model->key}}" name="consent_option[{{$model->id}}]"
                {{old('consent_option.'.$model->id)=="1"?'checked ':''}}
                {{$model->is_mandatory?'required':''}}
        >
        <label class="form-check-label" for="{{$model->key}}">
            {{$model->label??''}}
            @if($model->is_mandatory)
                <span class="text-danger">*</span>
            @endif
        </label>
    </div>
</div>