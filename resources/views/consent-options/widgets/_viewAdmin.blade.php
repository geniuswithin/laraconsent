<h1>{{ $consentOption }}</h1>
<div class="mb-20 consent-content"> {!! $consentOption->text !!}</div>
<hr>
<div class="d-flex justify-content-between">
    <div class="h4">{{__('Applies to')}}: {!! $consentOption->userTypesBadges !!}</div>
    <div class="h4">
        <span class="badge badge-secondary"><i class="fa fa-thumbs-up"></i> {{__('Accepted')}} {{ $consentOption->usersAcceptedTotal }}</span>
        @if(!$consentOption->is_mandatory)
            <span class="badge badge-secondary"><i class="fa fa-thumbs-down" aria-hidden="true"></i> {{__('Declined')}} {{ $consentOption->usersDeclinedTotal }}</span>
        @endif
    </div>
</div>
<div class="h4">{{__('Status')}}: {!! $consentOption->statusBadge!!} </div>