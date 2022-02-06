<div class="mb-4">
    @isset($label)
        <label class="form-label" for="{{$name??''}}">{{ $label }}</label>
    @endisset
        @isset($btnAfter)
            <div class="input-group">
        @endisset
        <select name="{{ $name ?? '' }}" id="{{ $id ?? '' }}" class="form-select js-select2 {{ $class ?? '' }}" style="{{ $style ?? '' }}"
                @isset($multiple)
                multiple
                @endisset
                @isset($tags)
                data-tags="true"
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
            @isset($btnAfter)
                <button type="button" class="btn {{$btnAfterClass}}">{{$btnAfter}}</button>
            </div>
            @endisset

</div>