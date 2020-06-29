<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>

<body>
    <div  id="app">
        <router-view></router-view>
    </div>
    <script src="{{ asset('/main/main.js') }}"></script>
</body>

</html>