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
        {{$client->full_name}},congratulations you have successfully passed the registration. Your library card {{$client->library_card_id}}
    </p>
    <img src="{{ asset('storage/clients/' . $client->id) }}" alt="img not found">
</div>
</body>
</html>
