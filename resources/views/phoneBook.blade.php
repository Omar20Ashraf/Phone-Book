<!DOCTYPE html>
<html>
<head>
    <title>Phone Book</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
</head>
<body>
    <div id="app">
        <myheader></myheader>

        <div class="container">
            <router-view></router-view>
        </div>

        <myfooter></myfooter>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
</body>
</html>
