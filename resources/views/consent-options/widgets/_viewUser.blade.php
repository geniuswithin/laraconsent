@forelse ($consentOptions as $consentOption)
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center">
            <h3 class="mb-0">{{$consentOption}}</h3>
        </div>
        <div class="card-body">
            <div class="mb-2 consent-content">{!!$consentOption->text!!}</div>
            <div style="margin-bottom: 1em; text-align: right">{{__('Last Updated')}}: {{$consentOption->updated_at->format('d M Y')}}</div>
            @if($consentOption->is_mandatory)
                <div class="h4 my-3"><span class="badge badge-success">{{__('Accepted on')}} {{$consentOption->pivot->created_at->format('jS M Y H:i')}}</span></div>
            @endif
            @if(!$consentOption->is_mandatory)
                    <div class="form-group d-flex align-items-center justify-content-start @error('consent_option.'.$consentOption->id) is-invalid @enderror"


                    >
                        <div class="custom-control custom-switch custom-control-primary custom-control-lg d-flex justify-content-end js-toggle-consent" style="cursor: pointer"
                             data-url="{{route((config('laraconsent.routes.user.prefix').'.toggle'),['consentOptionUser'=>$consentOption->pivot->id])}}"
                        >
                            <input type="hidden" name="consent_option[{{$consentOption->id}}]" value='0'>
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="{{$consentOption->key}}"
                                   name="consent_option[{{$consentOption->id}}]"
                                   value='1'
                                    {{$consentOption->pivot->accepted?'checked':''}}
                                    {{$consentOption->is_mandatory?'required':''}}
                            >
                            <label class="custom-control-label "
                                   for="{{$consentOption->key}}"
                                   style="cursor:pointer">{{$consentOption->label??''}}
                                @if($consentOption->is_mandatory)
                                    &nbsp;<span class="text-danger">*</span>
                                @endif
                            </label>
                        </div>
                    </div>
            @else

            @endif
            @error('consent_option.'.$consentOption->id)
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <hr class="my-3"/>
@empty
    <p>{{__('You have not provided any consents.')}}</p>
@endforelse
@if(count($consentOptions))
    <input type="submit" value="{{__('Update your consent options')}}" style="display: block; width: 100%; margin-top: 2em" class="btn btn-lg btn-primary">
@endif

@push('scripts')
    <script>
        jQuery(function () {
            LaraConsent.helpers(['toggleUserConsent']);
        });
    </script>
@endpush