<nav class="navbar navbar-default" role="navigation">
    <div class="collapse  navbar-collapse" id="readable-navbar-collapse">
        <ul class="navigation">
            <li class="dropdown active">
                <a href="/" class="dropdown-toggle" data-toggle="dropdown">Home page</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Test</a>
                <ul class="navigation__dropdown">
                    <li><a href="#">Item 1</a></li>
                    <li><a href="#">Item 2</a></li>
                    <li><a href="#">Item 3</a></li>
                    <li><a href="#">Item 4</a></li>
                </ul>
            </li>
            <li class="">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Web</a>
            </li>
            <li class="">
                <a href="/about" class="dropdown-toggle" data-toggle="dropdown">About me</a>
            </li>
            {{--TODO change href links to route method--}}
            <li class="">
                <a href="/contact" class="dropdown-toggle" data-toggle="dropdown">Contact me</a>
            </li>

            @if($isAuth)
                <li class="login">
                    You are tom<a href="/" class="dropdown-toggle" data-toggle="dropdown">Logout</a>
                </li>
            @else
                <li class="login">
                    <a href="/" class="dropdown-toggle" data-toggle="dropdown">Login</a>
                </li>
            @endif
        </ul>
    </div>
</nav>