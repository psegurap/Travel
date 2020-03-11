<h3>User information:</h3>
<ul>
    <li><strong>Name:</strong> {{$data->user_name}}</li>
    <li><strong>Email:</strong> {{$data->user_email}}</li>
    <li><strong>Subject:</strong> {{$data->subject}}</li>
    <li><strong>Language:</strong> {{$data->user_lang}}</li>
</ul>

<h3>Message:</h3>
<pre style="margin:0px">
<p style="font-size: 16px; text-align: justify; margin:0px">
{{$data->user_message}}
</p>
</pre>

<h3>Other information:</h3>
<ul>
    <li><strong>Date:</strong> {{$data->date}}</li>
    <li><strong>Time:</strong> {{$data->time}}</li>
</ul>