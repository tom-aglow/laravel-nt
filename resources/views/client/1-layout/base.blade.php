<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <title>{{ $title or 'I need a title' }}</title>

    <!--Import Google Font-->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,400italic|Roboto:400,700,500|Open+Sans:400,600&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{--materializecss--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
    <link rel="stylesheet" href="/css/main.css" />
    @yield('head-styles')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    {{--jQuery--}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    {{--materializecss--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/js/materialize.min.js"></script>
    <script src="/js/main.js?{{ sha1(microtime(true)) }}"></script>
    @yield('head-scripts')

</head>

<body>
    @yield('header')
    @yield('content')
    @yield('footer')

    @yield('bottom-scripts')

</body>
</html>