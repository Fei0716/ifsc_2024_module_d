<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{Asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{Asset('style.css')}}">
    <title>Martin Delivery | Admin Web Panel</title>
</head>
<body>
@include('layout.nav')
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{Asset('bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>
