<div class="form-group ">
    <label for="{{ $name ?? '' }}">{{ $label ?? '' }}
        @isset($required)
            &nbsp;<span class="text-danger">*</span>
        @endisset
    </label>
    <div class="input-group">
        <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </span>
        </div>
        <input type="text"
               class="js-flatpickr form-control form-control-lg {{$class??''}}"
               id="{{ $id??($name ?? '') }}"
               name="{{ $name ?? '' }}"
               data-input
               data-alt-input="true"
               @isset($required)
               required
               @endisset
               placeholder="Pick a date{{isset($enableTime)?' and time':''}}"
               @isset($minDate)
               data-min-date="{{$minDate}}"
               @endisset
               @isset($enableTime)
               data-enable-time="true"
               data-date-format="Y-m-d H:i"
               data-alt-format="D j M Y H:i"
               @else
               data-date-format="Y-m-d"
               data-alt-format="D j M Y"
               @endisset
               data-shorthand-current-month="true"
               data-value="{{$value??''}}"
               value="{{$value??''}}"
        >
    </div>
</div>
