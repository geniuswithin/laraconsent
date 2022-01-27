<div class="card">
    <div class="card-header d-flex align-items-center">
        <div class="h4 mb-0">{{$model}}</div>
        <div class="ml-auto d-flex align-items-center">
            @if($model->isHighestVersion)
            <a type="button" class="btn btn-sm btn-warning mr-2" data-toggle="tooltip" title="{{__('Edit')}} {{$model}}" href="{{route(config('laraconsent.routes.admin.prefix').'.edit',['consentOption'=>$model])
            }}">
                <i class="fa fa-pencil-alt"></i> {{__('Edit')}}
            </a>
            @else
                <i class="fa fa-lock text-danger mr-2"></i>
            @endif

            {!! $model->statusBadge!!}
        </div>
    </div>
    <div class="card-body">
        {!!$model->text!!}
        @component('laraconsent::components.inputs.toggle_consent',['model'=>$model])@endcomponent
        <div class="text-right text-lg">
        @if($model->published_at->lt(\Illuminate\Support\Carbon::now()))
                <span class="badge badge-info"><b>{{__('Published On')}}</b>: {{$model->published_at->format('jS M Y')}}</span>
        @else
            <span class="badge badge-danger"><b>{{__('Will be automatically published on')}}</b>: {{$model->published_at->format('jS M Y')}}</span>
        @endif
        </div>
    </div>
    <div class="card-footer text-muted">
        <div class="d-flex mt-2 align-items-center">
            <div class="h5 mb-0">
                {!!$model->requiredBadge!!}
                for
                {!!$model->userTypesBadges!!}
            </div>
            <div class="h5 ml-auto mb-0">
                {!!$model->usersAcceptedBadge!!}  {!!$model->usersDeclinedBadge!!}
            </div>
        </div>
    </div>
</div>