<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{!! asset('css/app.css') !!}">
</head>
<body>

@include('shared/navbar')

<div class="container">
    <div class="content">
        @yield('content')
    </div>
</div>

<script src="{!! asset('js/app.js') !!}"></script>

</body>
</html>
