<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}} | Notify</title>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/warning.css') }}">
</head>

<body>
    <header class="site-header text-center" id="header">
        <h1 class="site-header__title" data-lead-id="site-header-title">IP BLOCKED!</h1>
    </header>
    <div class="main-content text-center">
        <i class="glyphicon glyphicon-ban-circle main-content__checkmark" id="checkmark"></i>
        <p class="main-content__body" data-lead-id="main-content-body">Opoose!!! {{ $message }}  </p>
    </div>
    <div class="url text-center">
        <a href="{{url('/') }}" class="">Back to home</a>
    </div>
    <footer class="site-footer text-center" id="footer">
        <p class="site-footer__fineprint" id="fineprint">Copyright © {{date('Y')}} | {{env('APP_NAME')}} All Rights Reserved</p>
    </footer>
</body>

</html>