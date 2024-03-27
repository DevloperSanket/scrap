<!DOCTYPE html>
<html>
<head>
    {{-- <title>{{ $title }}</title> --}}
</head>
<body>
    {{-- <h2><b>{{ $title }}</b></h2>
    <p>{!! $body !!}</p> --}}

    @php
    $image_url = "frontend/theam/assets/images/logo/logo.png";
        
    @endphp

    <p>Hi, {{$data['name']}} <br><br> Your Scrap Collecting Request is Approved , 
         Our driver will pick the scrap for you. Below are the details of the driver and time who will pick up the scrap.<br>
         Driver Name: {{$data['driver_name']}} <br> Driver Mobile No: {{$data['driver_mobile']}}<br> Date : {{ $data['date'] }}<br> Time : {{ $data['time'] }}<br><br> Thank you For Choosing Us !!!<br>
         For any query Contact Us at : <br> Mobile no. - 1234567891<br>Email Us at : example@gmail.com<br> Website url : scrap24x7.com <br>
        <img src="{{ "data:image/png;base64,".base64_encode(file_get_contents($image_url )) }}" height='80' width='180' style="display: block; border: 0px;">
    </p>
</body>
</html>