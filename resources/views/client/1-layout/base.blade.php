<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="shortcut icon" href="/img/favicon.png">

    <title>{{ $title or 'I need a title' }}</title>


    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,400italic|Roboto:400,700,500|Open+Sans:400,600&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/main.css" />
    @yield('head-styles')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


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


{{--TODO make template for error pages--}}
{{--TODO what is tag 'base' with href (route(site.main.index))--}}