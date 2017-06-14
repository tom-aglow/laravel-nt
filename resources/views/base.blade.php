<!doctype html>
<html lang="en">
<head>
    <title>{{$title  or ''}}</title>

    <!-- ### meta attributes ###-->
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ### stylesheets ###-->
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <header>
        @section('header')
            <h3>This is default header</h3>
        @show
    </header>

    <main class="mainContent">
        @yield('content')
    </main>

    <footer>
        @section('footer')
            <h3>This is default footer</h3>
        @show
    </footer>

    @include('includes/copyright')
</body>
</html>