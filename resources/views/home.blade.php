<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>urfridge</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
</head>

<body>
    <div id="app">
        <navbar></navbar>
        <carousel-banner></carousel-banner>
        <social-media-bar></social-media-bar>
        <appfooter></appfooter>
    </div>
</body>
<script src="{{ mix('assets/js/app.js') }}"></script>

</html>