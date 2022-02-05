<div class="form-group">

    <label class=form-label">{{ $label ?? '' }}
        @isset($required)
            &nbsp;<span class="text-danger">*</span>
        @endisset
    </label>
    <textarea
            name="{{ $name ?? '' }}"
            id="{{ $id ?? '' }}"
            class="input form-control {{ $class ?? '' }}"
            rows="{{ $rows ?? 10 }}"
            cols="{{ $cols ?? 50}}"
            placeholder="{{ $placeholder ?? '' }}"
            @if (isset($required))
            required
  @endif
>

{{ $value ?? '' }}

</textarea>
</div>
