<div class="form-group">
    @isset($label)
        <label for="{{$name??''}}">{{ $label }}</label>
    @endisset
    <select name="{{ $name ?? '' }}" id="{{ $id ?? '' }}" class="form-control js-select2 {{ $class ?? '' }}" style="{{ $style ?? '' }}"
            @isset($multiple)
            multiple
            @endisset
    >
        @foreach ($options as $option)
            @if (isset($option->id))
                <option value="{{ $option->id ?? ''}}"
                        @if (isset($selected) && in_array($option->id, $selected))
                            selected
                        @endif
                        @isset($showUrl)
                        data-show-consent-url="{{route(config('laraconsent.routes.admin.prefix').'.show',['consentOption'=>$option->id])}}"
                        @endisset
                >
                    {{$option->name??''}}
               </option>
            @endif
        @endforeach
    </select>
</div>