<ul id="nav-mobile" class="right hide-on-med-and-down">
    <li class="active"><a href="{{ route('client.client.index') }}">Home</a></li>
    <li><a href="{{ route('client.about.show') }}">About</a></li>
    <li><a href="{{ route('client.client.index') }}">Posts</a></li>
    <li><a href="{{ route('client.contact.show') }}">Contact</a></li>
    <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons">account_circle</i></a></li>

</ul>

<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
    @if(Auth::check())
        <li class="login_info"><strong>{{ Auth::user()->name }}</strong></li>
        <li class="divider"></li>
        <li><a href="{{ route('client.auth.logout') }}">Logout</a></li>
    @else
        <li class="login_info">You are not logged in</li>
        <li class="divider"></li>
        <li><a href="{{ route('client.auth.login') }}">Log in</a></li>
    @endif
</ul>

