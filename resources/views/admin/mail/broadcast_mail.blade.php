{!! $broadcast_data->message !!}

<br/>
@if (App::getlocale() == 'es')
    <p style="text-align:center">
        <span>Copyright © {{$broadcast_data->year}} {{env('APP_NAME')}}, Inc. Todos los derechos reservados.</span><br/>
        <span>Este correo electrónico fue enviado a <em><strong><u>{{ $broadcast_data->email_address }}</strong></em></u>.</span><br/>
        <span>Recibió este correo electrónico porque se suscribió a nuestro sitio web <a href="{{env('APP_URL')}}"><strong>{{env('APP_NAME')}}</a></strong>.</span><br/>
        <span><a href="#" target="_blank">Cancelar Suscripción</a></span>
    </p>
@else    
    <p style="text-align:center">
        <span>Copyright © {{$broadcast_data->year}} {{env('APP_NAME')}}, Inc. All rights reserved.</span><br/>
        <span>This email was sent to <em><strong><u>{{ $broadcast_data->email_address }}</strong></em></u>.</span><br/>
        <span>You received this email because you subscribed in our website <a href="{{env('APP_URL')}}" target="_blank"><strong>{{env('APP_NAME')}}</strong></a>.</span><br/>
        <span><a href="#" target="_blank">Cancel Subscription</a></span>
    </p>
@endif