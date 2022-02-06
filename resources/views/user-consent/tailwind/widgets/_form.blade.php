<form method="POST" action="{{route((config('laraconsent.routes.user.prefix').'.store'))}}">
    @csrf
    @forelse ($consentOptions as $model)
        <div class="card mb-4 consent-content">
            <div class="card-header d-flex align-items-center">
                <div class="h4 mb-0">{{$model}}</div>
                <div class="h5 ms-auto">
                    {!!$model->requiredBadge!!}
                </div>
            </div>
            <div class="card-body">
                @if(Auth::user()->hasPreviousConsents($model->key))
                    @php($lastViewed = Auth::user()->lastConsentByKey($model->key))
                    <div class="alert alert-info">
                        {{ __('Our consent statement has been updated since you last '.($lastViewed->pivot->accepted?'accepted':'viewed'))." ".$lastViewed->pivot->created_at->diffForHumans()}}                    </div>
                @endif

                {!!$model->text!!}


                <p class="text-right mt-4">
                    {{__('Last Updated')}}: {{$model->updated_at->format('d M Y')}}
                </p>

                @component('laraconsent::components.'.config('laravel-admin-tools.css_format').'.inputs.toggle_consent',['model'=>$model])@endcomponent
            </div>
        </div>

    @empty
        <p> {{ __('All consents have been provided')}}</p>
    @endforelse
    <input type="submit" value="{{ __('Save Options')}}" style="display: block; width: 100%; margin-top: 2em" class="btn btn-lg btn-primary">
</form>