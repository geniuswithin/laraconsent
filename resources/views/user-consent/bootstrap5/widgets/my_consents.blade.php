@forelse ($consentOptions as $consentOption)

    <x-admintools-block title="{{$consentOption}}">

            <div class="mb-2 consent-content">{!!$consentOption->text!!}</div>
            <div style="margin-bottom: 1em; text-align: right">{{__('Last Updated')}}: {{$consentOption->updated_at->format('d M Y')}}</div>
            @if($consentOption->is_mandatory)
                <div class="h4 my-3"><span class="badge rounded-pill bg-success">{{__('Accepted on')}} {{$consentOption->pivot->created_at->format('jS M Y H:i')}}</span></div>
            @endif
            @if(!$consentOption->is_mandatory)
                    <div class="form-group d-flex align-items-center justify-content-start @error('consent_option.'.$consentOption->id) is-invalid @enderror">

                        <div class="mb-4">
                            <div class="form-check form-switch js-toggle-consent"
                                 data-url="{{route((config('laraconsent.routes.user.prefix').'.toggle'),['consentOptionUser'=>$consentOption->pivot->id])}}">

                                <input class="form-check-input" type="checkbox" value="1" id="{{$consentOption->key}}" name="consent_option[{{$consentOption->id}}]"
                                        {{$consentOption->pivot->accepted=="1"?'checked ':''}}
                                        {{$consentOption->is_mandatory?'required':''}}
                                >
                                <label class="form-check-label" for="{{$consentOption->key}}">
                                    {{$consentOption->label??''}}
                                    @if($consentOption->is_mandatory)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>

            @else

            @endif
            @error('consent_option.'.$consentOption->id)
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
    </x-admintools-block>

@empty
    <p>{{__('You have not provided any consents.')}}</p>
@endforelse

@push('scripts')
    <script>
        jQuery(function () {
            LaraConsent.helpers(['toggleUserConsent']);
        });
    </script>
@endpush