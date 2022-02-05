<form method="POST" action="{{route((config('laraconsent.routes.user.prefix').'.store'))}}">
    @csrf
    @forelse ($consentOptions as $model)
        <x-admintools-block title="{{$model}}">
            <x-slot name="buttons">
                {!!$model->requiredBadge!!}
            </x-slot>

            @if(Auth::user()->hasPreviousConsents($model->key))
                @php($lastViewed = Auth::user()->lastConsentByKey($model->key))
                <div class="alert alert-info">
                    {{ __('Our consent statement has been updated since you last '.($lastViewed->pivot->accepted?'accepted':'viewed'))." ".$lastViewed->pivot->created_at->diffForHumans()}}                    </div>
            @endif

            {!!$model->text!!}


            <p class="text-right mt-4">
                {{__('Last Updated')}}: {{$model->updated_at->format('d M Y')}}
            </p>

            @component('laraconsent::components.'.config('laraconsent.css_format').'.inputs.toggle_consent',['model'=>$model])@endcomponent

        </x-admintools-block>
    @empty
        <p> {{ __('All consents have been provided')}}</p>
    @endforelse
    <input type="submit" value="{{ __('Save Options')}}" style="display: block; width: 100%; margin-top: 2em" class="btn btn-lg btn-primary">
</form>