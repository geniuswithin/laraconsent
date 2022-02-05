<div class="mb-4">
    <label class="form-label" for="{{$name??''}}">{{ $label ?? ($name??'') }}
        @isset($required)
            &nbsp;<span class="text-danger">*</span>
        @endisset
    </label>
    <input
            class="form-control form-control-lg  {{ $class ?? '' }} {{ isset($name)?($errors->has($name) ? ' is-invalid' : ''):'' }}"
            type="{{ $type ?? 'text' }}"
            name="{{ $name ?? '' }}"
            @isset($id)
            id="{{ $id ?? '' }}"
            @endisset

            @if(isset($tabindex))
            tabindex="{{$tabindex??''}}"
            @endif

            placeholder="{{ $placeholder ?? '' }}"
            value="{{ old($name, ($value??'')) }}"
            @isset($disabled)
            disabled aria-disabled="disabled"
            @endisset

            @if(isset($checked) && $checked == 1)
            checked
            @endif

            @isset($onChange)
            onchange="{{$onChange}}"
            @endisset
    >
    {!! isset($name)?$errors->first($name, '<p class="invalid-feedback">:message</p>'):'' !!}
</div>


