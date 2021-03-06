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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/bower_components/jquery/dist/jquery.min.js"><\/script>')</script>

    {{--materializecss--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
    {{--<script src="/public/bower_components/materialize/dist/js/materialize.min.js"></script>--}}

    <script src="/js/main.js?{{ sha1(microtime(true)) }}"></script>

    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'username' => (Auth::user()) ? Auth::user()->username : '',
            'signedIn' => Auth::check()
        ]) !!};
    </script>
    @yield('head-scripts')

</head>

<body>
    <div id='app'>
        @yield('header')
        @yield('content')
        <flash message="{{ session('flash') }}"></flash>

        @yield('footer')
        @yield('bottom-scripts')
    </div>

    {{--vue--}}
    <script src="/js/app.js"></script>

</body>
</html>