<nav class="navbar navbar-default" role="navigation">
    <div class="" id="readable-navbar-collapse">
        <ul class="navigation">
            <li class="dropdown active">
                <a href="{{ route('client.client.index') }}" class="dropdown-toggle" data-toggle="dropdown">Home page</a>
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
            <li class="">
                <a href="{{ route('client.auth.signup') }}" class="dropdown-toggle" data-toggle="dropdown">Sign up</a>
            </li>

            @if(Auth::check())
                <li class="">
                    You are {{ Auth::user()->name }}<a href="{{ route('client.auth.logout') }}" class="dropdown-toggle" data-toggle="dropdown">Logout</a>
                </li>
            @else
                <li class="">
                    <a href="/login" class="dropdown-toggle" data-toggle="dropdown">Log in</a>
                </li>
            @endif
        </ul>
    </div>
</nav>