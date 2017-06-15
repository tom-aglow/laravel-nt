<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>{{ $titel or 'Need a title' }}</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,400italic|Roboto:400,700,500|Open+Sans:400,600&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/main.css" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<header class="header  push-down-45">
    @section('header')
    <div class="container">
        @include('client.includes.header-logo')
        @include('client.includes.header-navbar-toggle')

        @section('navbar')
        <nav class="navbar navbar-default" role="navigation">
            <div class="collapse  navbar-collapse" id="readable-navbar-collapse">
                <ul class="navigation">
                    <li class="dropdown active">
                        <a href="index.html" class="dropdown-toggle" data-toggle="dropdown">Home page</a>
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
                    <li class="">
                        <a href="/contact" class="dropdown-toggle" data-toggle="dropdown">Contact me</a>
                    </li>
                </ul>
            </div>
        </nav>
        @show

        @include('client.includes.header-search-bar')
    </div>
    @show
</header>

@include('client.includes.header-search-panel')

@section('main-content')
<div class="container">
    <div class="row">
        @yield('page-content')
        @section('side-bar')
            <div class="col-xs-12  col-md-4">
                <div class="widget-author  boxed  push-down-30">
                    <div class="widget-author__image-container">
                        <div class="widget-author__avatar--blurred">
                            <img src="img/dummy/about-1.jpg" alt="Avatar image" width="90" height="90">
                        </div>
                        <img class="widget-author__avatar" src="img/dummy/about-1.jpg" alt="Avatar image" width="90" height="90">
                    </div>
                    <div class="row">
                        <div class="col-xs-10  col-xs-offset-1">
                            <h4>John Smith</h4>
                            <p>Web developer, PHP developer, blogger</p>
                        </div>
                    </div>
                </div>
                <div class="sidebar  boxed  push-down-30">
                    <div class="row">
                        <div class="col-xs-10  col-xs-offset-1">

                            <div class="widget-categories  push-down-30">
                                <h6>Topics</h6>
                                <ul>
                                    <li>
                                        <a href="#">Developmen &nbsp; <span class="widget-categories__text">(16)</span> </a>
                                    </li>
                                    <li>
                                        <a href="#">PHP &nbsp; <span class="widget-categories__text">(13)</span> </a>
                                    </li>
                                    <li>
                                        <a href="#">JavaScript &nbsp; <span class="widget-categories__text">(9)</span> </a>
                                    </li>
                                    <li>
                                        <a href="#">Lifestyle &nbsp; <span class="widget-categories__text">(23)</span> </a>
                                    </li>
                                    <li>
                                        <a href="#">Travek &amp; Quests &nbsp; <span class="widget-categories__text">(3)</span> </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="widget-featured-post  push-down-30">
                                <h6>Favorite posts</h6>
                                <img src="img/dummy-licensed/blog-image.jpg" alt="Featured post" width="293" height="127">
                                <h4>
                                    <a href="post.html">My favorite post</a>
                                </h4>
                                <p>Vivamus nec vulputate justo?</p>
                            </div>

                            <div class="widget-posts  push-down-30">
                                <h6>Populat / New</h6>

                                <ul class="nav  nav-tabs">
                                    <li class="active">
                                        <a href="#recent-posts" data-toggle="tab"> <span class="glyphicon  glyphicon-time"></span> &nbsp;New</a>
                                    </li>
                                    <li>
                                        <a href="#popular-posts" data-toggle="tab"> <span class="glyphicon  glyphicon-flash"></span> &nbsp;Popular </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane  fade  in  active" id="recent-posts">
                                        <div class="push-down-15">
                                            <img src="img/dummy-licensed/blog-image-small.jpg" alt="Posts">
                                            <h5>
                                                <a href="post.html">This is a showcase of the most recent posts</a>
                                            </h5>
                                            <span class="widget-posts__time">19 hours ago</span>
                                        </div>
                                        <div class="push-down-15">
                                            <img src="img/dummy-licensed/blog-image-3-small.jpg" alt="Posts">
                                            <h5>
                                                <a href="post.html">This is a showcase of the most recent posts</a>
                                            </h5>
                                            <span class="widget-posts__time">19 hours ago</span>
                                        </div>
                                        <div class="push-down-15">
                                            <img src="img/dummy-licensed/blog-image-small.jpg" alt="Posts">
                                            <h5>
                                                <a href="post.html">This is a showcase of the most recent posts</a>
                                            </h5>
                                            <span class="widget-posts__time">19 hours ago</span>
                                        </div>
                                    </div>
                                    <div class="tab-pane  fade" id="popular-posts">
                                        <div class="push-down-15">
                                            <img src="img/dummy-licensed/blog-image-3-small.jpg" alt="Posts">
                                            <h5>
                                                <a href="post.html">This is a showcase of the most popular posts</a>
                                            </h5>
                                            <span class="widget-posts__time">9 hours ago</span>
                                        </div>
                                        <div class="push-down-15">
                                            <img src="img/dummy-licensed/blog-image-small.jpg" alt="Posts">
                                            <h5>
                                                <a href="post.html">This is a showcase of the most popular posts</a>
                                            </h5>
                                            <span class="widget-posts__time">12 hours ago</span>
                                        </div>
                                        <div class="push-down-15">
                                            <img src="img/dummy-licensed/blog-image-3-small.jpg" alt="Posts">
                                            <h5>
                                                <a href="post.html">This is a showcase of the most popular posts</a>
                                            </h5>
                                            <span class="widget-posts__time">19 hours ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tags  widget-tags">
                                <h6>Тэги</h6>
                                <hr>
                                <a href="#" class="tags__link">Development</a>
                                <a href="#" class="tags__link">Web</a>
                                <a href="#" class="tags__link">UI/UX</a>
                                <a href="#" class="tags__link">Lifestyle</a>
                                <a href="#" class="tags__link">About all</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @show
    </div>
</div>
@show

<footer class="footer">
    @section('footer')
    <div class="container">
        <div class="col-xs-12  col-md-3">
            <nav class="widget-navigation  push-down-30">
                <h6>Social media</h6>
                <hr>
                <div class="social-icons  widget-social-icons">
                    <a href="#" class="social-icons__container"> <span class="zocial-facebook"></span> </a>
                    <a href="#" class="social-icons__container"> <span class="zocial-twitter"></span> </a>
                    <a href="#" class="social-icons__container"> <span class="zocial-youtube"></span> </a>
                </div>
            </nav>
        </div>

        <div class="col-xs-12  col-md-3 col-md-offset-1">
            <nav class="widget-navigation  push-down-30">
                <h6>Sitemap</h6>
                <hr>
                <ul class="navigation">
                    <li> <a href="/">Home page</a> </li>
                    <li> <a href="#">News</a> </li>
                    <li> <a href="/article">Articles</a> </li>
                    <li> <a href="/about">About me</a> </li>
                    <li> <a href="/contact">Contact me</a> </li>
                </ul>
            </nav>
        </div>
        <div class="col-xs-12  col-md-4 col-md-offset-1">
            <div class="widget-contact  push-down-30">
                <h6>Contacts</h6>
                <hr>
                <span class="widget-contact__text">
                    <span class="widget-contact__title">John Smith</span>
                    <br>Email: john@smith.com
                    <br>Skype: jognsmith
                    <br>VK: https://facebook.com/johnsmith
                    </span>
            </div>
        </div>
    </div>
    @show
</footer>

@include('client.includes.footer-copyright')


<script src="js/main.js"></script>
</body>
</html>