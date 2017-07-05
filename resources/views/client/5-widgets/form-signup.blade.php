<div class="boxed  push-down-45">
    <div class="row">
        <div class="col-xs-10  col-xs-offset-1">
            <div class="contact">
                <h2>Sign up</h2>
                <p class="contact__text">Ut ullamcorper, risus a rhoncus fringilla, dui nisl viverra nunc, quis consectetur massa purus a nulla.</p>
                <form action="/signup" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-12">
                            @if ($errors->has('name'))
                                <span style="margin-bottom: 20px; color: red;">{{ $errors->get('name')[0] }}</span>
                            @endif
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name *">

                            @if ($errors->has('username'))
                                <span style="margin-bottom: 20px; color: red;">{{ $errors->get('username')[0] }}</span>
                            @endif
                            <input type="text" name="username" value="{{ old('username') }}" placeholder="Your Login *">

                            @if ($errors->has('email'))
                                <span style="margin-bottom: 20px; color: red;">{{ $errors->get('email')[0] }}</span>
                            @endif
                            <input type="text" name="email" value="{{ old('email') }}" placeholder="E-mail Address *">

                            @if ($errors->has('password'))
                                <span style="margin-bottom: 20px; color: red;">{{ $errors->get('password')[0] }}</span>
                            @endif
                            <input type="password" name="password" placeholder="Your password *">

                            @if ($errors->has('password2'))
                                <span style="margin-bottom: 20px; color: red;">{{ $errors->get('password2')[0] }}</span>
                            @endif
                            <input type="password" name="password2" placeholder="Repeat your password *">

                            @if ($errors->has('isConfirmed'))
                                <span style="margin-bottom: 20px; color: red;">{{ $errors->get('isConfirmed')[0] }}</span>
                            @endif
                            <input type="checkbox" name="isConfirmed" id="isConfirmed" checked><label for="isConfirmed">I agree with everything</label>
                            <input type="submit" value="Sign up">

                            {{--<a href="#" class="btn  btn-primary">Sign up</a> --}}
                            <span class="contact__obligatory">Fields marked with * are obligatory</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

