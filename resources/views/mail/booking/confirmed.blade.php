<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--    <title>Document</title>--}}
</head>
<body>

<div style="font-family: Arial; font-size: 12px;">
    <p>
        Name: {{$booking->client->full_name}}<br>
        Phone: {{$booking->client->phone_number}}<br>
        Email: {{$booking->client->email}}<br>
    </p>
    To you book id = {{$booking->book->id}} booking confirmed. Booking id = {{$booking->id}}
</div>
</body>
</html>
