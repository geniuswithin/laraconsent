<p>{{__('laraconsent::user.email-opening')}}</p>
<hr>
@foreach($consentOptions as $consentOption)

    <h2>{{$consentOption}}</h2>

    <div style="margin-bottom: 20px">{!!$consentOption->text!!}</div>

    <h4>{{__("You ".($consentOption->pivot->accepted?'accepted':'declined') .' on')}} {{$consentOption->pivot->created_at->format('jS M Y H:i')}}</h4>

    <hr style="margin:20px 0">
@endforeach
