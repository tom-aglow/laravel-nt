<form action="{{ route('client.auth.signupPost') }}" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col l10 offset-l1">
            <div class="input-field col l12">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name" required>
                <label for="name" data-error="wrong" data-success="right">Name *</label>
                @if ($errors->has('name'))
                    <span style="margin-bottom: 20px; color: red;">{{ $errors->get('name')[0] }}</span>
                @endif
            </div>

            <div class="input-field col l12">
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Your Login" required>
                <label for="username" data-error="wrong" data-success="right">Login *</label>
                @if ($errors->has('username'))
                    <span style="margin-bottom: 20px; color: red;">{{ $errors->get('username')[0] }}</span>
                @endif
            </div>

            <div class="input-field col l12">
                <input type="email" class="validate" name="email" value="{{ old('email') }}" placeholder="E-mail Address" required>
                <label for="email" data-error="wrong" data-success="right">Email *</label>
                @if ($errors->has('email'))
                    <span style="margin-bottom: 20px; color: red;">{{ $errors->get('email')[0] }}</span>
                @endif
            </div>

            <div class="input-field col l12">
                <input type="password" name="password" data-length="20" placeholder="Your password" required>
                <label for="password" data-error="wrong" data-success="right">Password *</label>
                @if ($errors->has('password'))
                    <span style="margin-bottom: 20px; color: red;">{{ $errors->get('password')[0] }}</span>
                @endif
            </div>

            <div class="input-field col l12">
                <input type="password" name="password2" data-length="20" placeholder="Repeat your password" required>
                <label for="name" data-error="wrong" data-success="right">Repeat password *</label>
                @if ($errors->has('password2'))
                    <span style="margin-bottom: 20px; color: red;">{{ $errors->get('password2')[0] }}</span>
                @endif
            </div>

            <p>
                <input type="checkbox" name="isConfirmed" class="filled-in" id="isConfirmed" checked required>
                <label for="isConfirmed">I agree with everything *</label>
                @if ($errors->has('isConfirmed'))
                    <span style="margin-bottom: 20px; color: red;">{{ $errors->get('isConfirmed')[0] }}</span>
                @endif
            </p>

            <input type="submit" value="Sign up" class="btn btn__login">
        </div>
    </div>
</form>
<div class="row">
    <div class="col l10 offset-l1">
        <div class="login__social">Sign up with <a href="{{ route('client.auth.provider', 'facebook') }}">Facebook</a></div>
    </div>
</div>


