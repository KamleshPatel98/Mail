<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>forgot</title>
</head>
<body>
    <form action="{{ route('changePassword') }}">
        <input type="text" name="otp">
        <input type="password" name="password">
        <button type="submit">Submit</button>
    </form>
</body>
</html>