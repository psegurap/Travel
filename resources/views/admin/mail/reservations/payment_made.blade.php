<div class="container">
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tbody>
            <tr>
                <td align="center" valign="top">
                    <div id="m_3867218520512858963template_header_image">
                    </div>
                    <font color="#888888">
                        </font><font color="#888888">
                    </font>
                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3867218520512858963template_container" style="background-color:#ffffff;border:1px solid #dedede;border-radius:3px">
                        <tbody>
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3867218520512858963template_header" style="background-color:#ef2831;color:#202020;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;border-radius:3px 3px 0 0">
                                        <tbody>
                                            <tr>
                                                <td id="m_3867218520512858963header_wrapper" style="padding:36px 48px;display:block">
                                                    <h1 style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left;color:white">{{__('Reservation Update')}}:</h1>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <font color="#888888">
                                        </font><font color="#888888">
                                    </font>
                                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3867218520512858963template_body">
                                        <tbody>
                                            <tr>
                                                <td valign="top" id="m_3867218520512858963body_content" style="background-color:#ffffff">
                                                    <font color="#888888">
                                                        </font><font color="#888888">
                                                    </font>
                                                    <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" style="padding:30px 48px 32px">
                                                                    <div id="m_3867218520512858963body_content_inner" style="color:#636363;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">
                                                                        <p style="margin:0 0 16px">{{__('Your reservation details are as follows')}}:</p>
                                                                        <h2 style="color:#ef2831;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">Ticket #: {{$data->ticket_number}}</h2>
                                                                        <h2 style="color:#ef2831;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">{{__('Status')}}: {{$data->reservation_status}}</h2>
                                                                        <div style="margin-bottom:40px">
                                                                            <table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th colspan="3" scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">{{__('Trip selected')}}: <a href="{{$data->trip_url}}" style="font-weight:normal;text-decoration:none;color:#ef2831" target="_blank">{{$data->trip_selected}}</a></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                </tbody>
                                                                                <tfoot>
                                                                                    <tr>
                                                                                        <th scope="row" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:2px"></th>
                                                                                        <th scope="row" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:2px">{{__('Quantity')}}:</th>
                                                                                        <th scope="row" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:2px"></th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">{{__('Adults')}}:</th>
                                                                                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span>{{$data->adults_quantity}}</span></td>
                                                                                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span><span>$</span>{{$data->adults_total}}</span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">{{__('Kids')}}:</th>
                                                                                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span>{{$data->kids_quantity}}</span></td>
                                                                                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span><span>$</span>{{$data->kids_total}}</span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Total:</th>
                                                                                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span><strong><span>$</span>{{$data->adults_kids_total}}</strong> </span></td>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                        </div>
                                                                        <table id="m_3867218520512858963addresses" cellspacing="0" cellpadding="0" border="0" style="width:100%;vertical-align:top;margin-bottom:40px;padding:0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td valign="top" width="50%" style="text-align:left;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;border:0;padding:0">
                                                                                        <h2 style="color:#ef2831;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">{{__('Information provided')}}:</h2>

                                                                                        <address style="padding:12px;color:#636363;border:1px solid #e5e5e5">
                                                                                            <strong>{{__('Name')}}:</strong> {{$data->customer_name}}<br>
                                                                                            <strong>{{__('Email')}}:</strong> {{$data->customer_email}}<br>
                                                                                            <strong>{{__('Address')}}:</strong> {{$data->customer_address}}<br>
                                                                                            <strong>{{__('City')}}:</strong> {{$data->customer_city}}<br>
                                                                                            <strong>{{__('Zip Code')}}:</strong> {{$data->customer_zipCode}}<br>
                                                                                            <strong>{{__('Country')}}:</strong> {{$data->customer_country}}<br>
                                                                                            <strong>{{__('Phone')}}:</strong> {{$data->customer_phone}}<br>
                                                                                        </address>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <p style="margin:0 0 16px">
                                                                            <strong>{{__('Your payment has been processed')}}.</strong>
                                                                        </p>
                                                                        <font color="#888888">
                                                                        </font>
                                                                    </div>
                                                                    <font color="#888888">
                                                                    </font>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <font color="#888888">
                                                    </font>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <font color="#888888">
                                    </font>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <font color="#888888">
                    </font>
                </td>
            </tr>
        </tbody>
    </table>
</div>