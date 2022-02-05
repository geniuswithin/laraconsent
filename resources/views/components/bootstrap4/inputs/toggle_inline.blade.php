<div class="form-group {{$groupClass??''}} d-flex align-items-center {{isset($left)?'justify-content-start':(isset($center)?'justify-content-center':'justify-content-end')}}">
    <div class="custom-control custom-switch custom-control-{{$colour??'primary'}} custom-control-lg d-flex justify-content-end" style="cursor: pointer">
        <input type="hidden" name="{{$name}}" value='0'>
        <input type="checkbox"
               class="custom-control-input"
               id="{{$name}}"
               name="{{$name}}"
               value='1'
               @isset($consentOption)
                    data-consent-option="{{$consentOption}}"
               @endisset
               @isset($url)
                    data-url="{{$url}}"
               @endisset
               @if(isset($checked) && $checked)
                    checked
                @endisset
        >
        <label class="custom-control-label" for="{{$name}}">{{$label??''}}</label>
    </div>
</div>

