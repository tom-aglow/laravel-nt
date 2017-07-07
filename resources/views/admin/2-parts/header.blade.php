<header class="navbar navbar-inverse">
    <div class="container">
        <span class="navbar-brand text_logo">Admin panel</span>
        @if(Auth::user())
            <span class="navbar-brand text_logo navbar-user-info">user: {{ Auth::user()->username }}</span>
        @endif
        <ul class="nav navbar-nav navbar-right">
            <li class="navbar-li"><a href="{{ route('client.client.index') }}">go to the site</a></li>
            <li class="navbar-li"><a href="{{ route('admin.auth.logout') }}">logout</a></li>
        </ul>
    </div>
</header>