<div class="mb-4">
    <div class="form-check form-switch  @error($name) is-invalid @enderror">
        <input class="form-check-input" type="checkbox" value="1" id="{{$name}}" name="{{$name}}"
                {{old($name)=="1"?'checked ':''}}
                @if(isset($checked) && $checked)
                checked
                @endisset
        >
        <label class="form-check-label" for="{{$name}}">
            {{$label??''}}
            @isset($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    </div>
</div>

