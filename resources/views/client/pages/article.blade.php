@extends('client.main')

@section('main-content')
    <div class="container">
        <div class="boxed  push-down-60">
            <div class="meta">
                <img class="wp-post-image" src="images/dummy-licensed/blog-image.jpg" alt="Blog image" width="1138" height="493">
                <div class="row">
                    <div class="col-xs-12  col-sm-10  col-sm-offset-1  col-md-8  col-md-offset-2">
                        <div class="meta__container--without-image">
                            <div class="row">
                                <div class="col-xs-12  col-sm-8">
                                    <div class="meta__info">
                                        <span class="meta__date"><span class="glyphicon glyphicon-calendar"></span> &nbsp; 10 May 2017</span>
                                    </div>
                                </div>
                                <div class="col-xs-12  col-sm-4">
                                    <div class="comment-icon-counter-detail">
                                        <span class="glyphicon glyphicon-comment comment-icon"></span>
                                        <span class="comment-counter">10</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-10  col-xs-offset-1  col-md-8  col-md-offset-2  push-down-60">

                    <div class="post-content">
                        <h1>
                            <a href="#">Lorem ipsum dolor sit amet {{ $id }}</a>
                        </h1>
                        <h3>Praesent quis sollicitudin dolor</h3>
                        <p>
                            Praesent elementum lacus at porta sodales. Mauris consectetur ipsum aliquet enim porta, ut convallis enim lobortis. Sed ut ligula ut ex lobortis convallis. Mauris ultricies magna mattis volutpat tristique. Curabitur vel porta elit, nec lacinia risus. Suspendisse sit amet condimentum enim, a sollicitudin leo.
                        </p>
                        <h2>Aenean varius purus nec bibendum cursus</h2>
                        <p>
                            Praesent elementum lacus at porta sodales. Mauris consectetur ipsum aliquet enim porta, ut convallis enim lobortis. Sed ut ligula ut ex lobortis convallis. Mauris ultricies magna mattis volutpat tristique. Curabitur vel porta elit, nec lacinia risus. Suspendisse sit amet condimentum enim, a sollicitudin leo.
                        </p>
                        <blockquote>
                            “Donec posuere magna nec sapien condimentum, sed euismod arcu malesuada” - Albert Einstein
                        </blockquote>
                        <p>
                            Praesent elementum lacus at porta sodales. Mauris consectetur ipsum aliquet enim porta, ut convallis enim lobortis. Sed ut ligula ut ex lobortis convallis. Mauris ultricies magna mattis volutpat tristique. Curabitur vel porta elit, nec lacinia risus. Suspendisse sit amet condimentum enim, a sollicitudin leo.
                        </p>
                        <blockquote class="blockquote__alternative">
                            Donec posuere magna nec sapien condimentum, sed euismod arcu malesuada
                            <p>
                                <br>- Albert Einstein</p>
                        </blockquote>
                        <h4>Mauris porta vehicula augue</h4>
                        <p>
                            Praesent elementum lacus at porta sodales. Mauris consectetur ipsum aliquet enim porta, ut convallis enim lobortis. Sed ut ligula ut ex lobortis convallis. Mauris ultricies magna mattis volutpat tristique. Curabitur vel porta elit, nec lacinia risus. Suspendisse sit amet condimentum enim, a sollicitudin leo.
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-xs-12  col-sm-6">

                            <div class="post-comments">
                                <a class="btn  btn-primary" href="single-post-without-image.html">Comments (3)</a>
                            </div>

                        </div>
                        <div class="col-xs-12  col-sm-6">

                            <div class="social-icons">
                                <a href="#" class="social-icons__container"> <span class="zocial-facebook"></span> </a>
                                <a href="#" class="social-icons__container"> <span class="zocial-twitter"></span> </a>
                                <a href="#" class="social-icons__container"> <span class="zocial-email"></span> </a>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="tags">
                                <h6>Tags</h6>
                                <hr>
                                <a href="#" class="tags__link">Development</a>
                                <a href="#" class="tags__link">Web</a>
                                <a href="#" class="tags__link">UI/UX</a>
                                <a href="#" class="tags__link">Lifestyle</a>
                                <a href="#" class="tags__link">About all</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="comments">
                                <h6>Comments</h6>
                                <hr>
                                <div class="comment clearfix">
                                    <div class="comment-avatar pull-left">
                                        <img src="images/dummy/about-5.jpg" alt="User Avatar" class="img-circle comment-avatar-image">
                                    </div>
                                    <div class="comment-body clearfix">
                                        <div class="comment-header">
                                            <strong class="primary-font">Jimmy Carlson</strong>
                                            <small class="pull-right text-muted">
                                                <span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;15 May 2017 10:12
                                            </small>
                                        </div>
                                        <p class="comment-text">
                                            Vestibulum malesuada turpis non lacus facilisis pulvinar. Ut varius auctor arcu in gravida. Praesent in fringilla elit, eu efficitur leo. In hac habitasse platea dictumst. Pellentesque sed mattis justo. Phasellus imperdiet justo ligula, non auctor purus feugiat eu. Phasellus accumsan molestie nisl, quis porttitor leo elementum id.
                                        </p>
                                    </div>
                                </div>
                                <div class="comment clearfix">
                                    <div class="comment-avatar pull-left">
                                        <img src="images/dummy/about-5.jpg" alt="User Avatar" class="img-circle comment-avatar-image">
                                    </div>
                                    <div class="comment-body clearfix">
                                        <div class="comment-header">
                                            <strong class="primary-font">Jimmy Carlson</strong>
                                            <small class="pull-right text-muted">
                                                <span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;15 May 2017 10:12
                                            </small>
                                        </div>
                                        <p class="comment-text">
                                            Vestibulum malesuada turpis non lacus facilisis pulvinar. Ut varius auctor arcu in gravida. Praesent in fringilla elit, eu efficitur leo. In hac habitasse platea dictumst. Pellentesque sed mattis justo. Phasellus imperdiet justo ligula, non auctor purus feugiat eu. Phasellus accumsan molestie nisl, quis porttitor leo elementum id.
                                        </p>
                                    </div>
                                </div>
                                <div class="comment clearfix">
                                    <div class="comment-avatar pull-left">
                                        <img src="images/dummy/about-5.jpg" alt="User Avatar" class="img-circle comment-avatar-image">
                                    </div>
                                    <div class="comment-body clearfix">
                                        <div class="comment-header">
                                            <strong class="primary-font">Jimmy Carlson</strong>
                                            <small class="pull-right text-muted">
                                                <span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;15 May 2017 10:12
                                            </small>
                                        </div>
                                        <p class="comment-text">
                                            Vestibulum malesuada turpis non lacus facilisis pulvinar. Ut varius auctor arcu in gravida. Praesent in fringilla elit, eu efficitur leo. In hac habitasse platea dictumst. Pellentesque sed mattis justo. Phasellus imperdiet justo ligula, non auctor purus feugiat eu. Phasellus accumsan molestie nisl, quis porttitor leo elementum id.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection