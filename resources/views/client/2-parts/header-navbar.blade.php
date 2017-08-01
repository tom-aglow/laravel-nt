<ul id="nav-mobile" class="right hide-on-med-and-down">
    @foreach($menu as $key => $value)
        <li class="{{ $value['active'] ? 'active' : '' }}"><a href="{{ route($value['path']) }}">{{ ucfirst($key) }}</a></li>
    @endforeach
    <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Channels</a></li>
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

<ul id="dropdown2" class="dropdown-content">
        @foreach(App\Models\Channel::all() as $channel)
                {{--TODO pull to view composer--}}
                <li><a href="{{ route('client.threads.channel', $channel->slug) }}">{{ $channel->name }}</a></li>
        @endforeach
</ul>
