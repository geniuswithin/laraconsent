<div class="block block-rounded">
    <div class="block-header block-header-default d-flex align-items-center">
        <div class="h4 mb-0"><a href="{{route(config('laraconsent.routes.admin.prefix').'.show',['consentOption'=>$model])}}">{{$model}}</a></div>
        <div class="ms-auto d-flex align-items-center">
            @if($model->isHighestVersion)
            <a type="button" class="btn btn-sm btn-warning me-2" data-bs-toggle="tooltip" title="{{__('Edit')}} {{$model}}" href="{{route(config('laraconsent.routes.admin.prefix').'.edit',['consentOption'=>$model])
            }}">
                <i class="fa fa-pencil-alt"></i> {{__('Edit')}}
            </a>
            @else
                <i class="fa fa-lock text-danger me-2"></i>
            @endif

            {!! $model->statusBadge!!}
        </div>
    </div>
    <div class="block-content">
        {!!$model->text!!}
        <hr>
        @component('laraconsent::components.'.config('laravel-admin-tools.css_format').'.inputs.toggle_consent',['model'=>$model])@endcomponent
        <p class="text-end fs-4">
        @if($model->published_at->lt(\Illuminate\Support\Carbon::now()))
                <span class="badge rounded-pill bg-info"><b>{{__('Published On')}}</b>: {{$model->published_at->format('jS M Y')}}</span>
        @else
            <span class="badge rounded-pill bg-danger"><b>{{__('Will be automatically published on')}}</b>: {{$model->published_at->format('jS M Y')}}</span>
        @endif
        </p>
    </div>
    <div class="block-header block-header-default fs-4">
            <div class="me-auto mb-0">
                {!!$model->requiredBadge!!}
                for
                {!!$model->userTypesBadges!!}
            </div>
            <div class="ms-auto mb-0">
                {!!$model->usersAcceptedBadge!!}  {!!$model->usersDeclinedBadge!!}
            </div>
    </div>
</div>