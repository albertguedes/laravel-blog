<!DOCTYPE html>
<html>
<head>
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>
    <h1>{{ $mail['subject'] }}</h1>
    <h2>{{ $mail['name'] }} &lt;<a href="mailto:{{ $mail['email'] }}" >{{ $mail['email'] }}</a>&gt;</h2>
    <p>{{ $mail['content'] }}</p>
   
    <p>Thank you</p>
</body>
</html>