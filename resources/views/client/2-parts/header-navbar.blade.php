<ul id="nav-mobile" class="right hide-on-med-and-down">
    @foreach($menu as $key => $value)
        <li class="{{ $value['active'] ? 'active' : '' }}"><a href="{{ route($value['path']) }}">{{ ucfirst($key) }}</a></li>
    @endforeach
    <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Threads<i class="material-icons right">arrow_drop_down</i></a></li>
    <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Channels<i class="material-icons right">arrow_drop_down</i></a></li>
    <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons">account_circle</i></a></li>

</ul>


{{--dropdown: authentication and user profile--}}
<ul id="dropdown1" class="dropdown-content">
    @if(auth()->check())
        <li class="login_info"><strong>{{ auth()->user()->name }}</strong></li>
        <li class="divider"></li>
        <li><a href="{{ route('client.profiles.show', ['uesr' => auth()->user()]) }}">My profile</a></li>
        <li class="divider"></li>
        <li><a href="{{ route('client.auth.logout') }}">Logout</a></li>
    @else
        <li class="login_info">You are not logged in</li>
        <li class="divider"></li>
        <li><a href="{{ route('client.auth.login') }}">Log in</a></li>
    @endif
</ul>

{{--dropdown: channels--}}
<ul id="dropdown2" class="dropdown-content">
        @foreach($channels as $channel)
                <li><a href="{{ route('client.threads.channel', $channel->slug) }}">{{ $channel->name }}</a></li>
        @endforeach
</ul>

{{--dropdown: threads--}}
<ul id="dropdown3" class="dropdown-content">

    <li><a href="{{ route('client.threads.index') }}">All Threads</a></li>
    <li><a href="{{ route('client.threads.index', ['popular' => 1]) }}">Popular All Time</a></li>
    @if(auth()->check())
        <li><a href="{{ route('client.threads.index', ['by' => auth()->user()->name]) }}">My Threads</a></li>
    @endif
    <li><a href="{{ route('client.threads.create') }}">New Thread</a></li>
</ul>
