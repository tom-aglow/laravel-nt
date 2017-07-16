<div class="col-xs-12  col-md-12">
    <div class="boxed  push-down-45">
        <div class="row">
            <div class="col-xs-10  col-xs-offset-1">
                <div class="contact">
                    @if(session('wasMessageSent'))
                        <h2>Message was sent</h2>
                        <p>Thank you for your feedback!</p>
                        <a href="{{ route('client.client.index') }}">Go back to home page</a>
                    @else
                        <h2>Contact Us</h2>
                        <p class="contact__text">Ut ullamcorper, risus a rhoncus fringilla, dui nisl viverra nunc, quis consectetur massa purus a nulla. Quisque adipiscing, eros eget molestie feugiat, dui sem laoreet est, nec convallis dolor erat et tellus.</p>
                        <form action="{{ route('client.contact.show') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-6">
                                    <input type="text" name="name" placeholder="Your Name *" value="{{ old('name') }}">
                                </div>
                                <div class="col-xs-6">
                                    <input type="text" name="email" placeholder="E-mail Address *" value="{{ old('email') }}">
                                </div>
                                <div class="col-xs-12">
                                    <textarea rows="6" name="message" placeholder="Your Message *">{{ old('message') }}</textarea>
                                    <input type="submit" value="Send Message" class="btn">
                                    <span class="contact__obligatory">Fields marked with * are obligatory</span>
                                </div>
                            </div>
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger article_msg">
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

