<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Donation </title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="{{secure_asset('css/elegant-fonts.css')}}">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="{{secure_asset('css/themify-icons.css')}}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{secure_asset('css/swiper.min.css')}}">
  
    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{secure_asset('style.css')}}">
    <style>
        .page-item.active .page-link{
            background-color:#ff5a00 !important;
            border-color: #ff5a00 ;
        }
        .pagination > li > a, .pagination > li > span {
            color: #ff5a00 ;
        }
    </style>
</head>
<body>
    <header id="app" class="site-header">
        <div class="top-header-bar">
            <div class="container">
                <div class="row d-flex">
                    <div style="justify-content:space-around;" class="d-flex col-12 ">
                        @if (Route::has('login'))
                        @if(auth::check())
                        <div class="col-5">
                            <div style="padding-top:20px" class="name"><a href="{{route('profile',Auth::user()->slug)}}"><p class="text-decoration-none d-flex">
                                @if(isset(auth()->user()->avater))
                                <img style="width:40px; height:40px; border-radius:50%;margin-right:10px" src="{{Auth::user()->avater}}" alt="">
                                @endif
                                
                                Logged in as <b class="text-capitalize">
                                {{" "}}{{Auth::user()->name}}</b></p></a>
                            </div>
                        </div>
                        @endif
                        @endif
                        <!-- .header-bar-text -->
                        @if (Route::has('login'))
                        @if(auth::check())
                        <div style="margin-top:13px;margin-bottom:13px" class="col-7" class="">
                            <form  class="form-inline my-2 my-lg-0 pull-right">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search by title or entrepreneur" aria-label="Search">
                                    <button class="btn btn-default" style="border-radius:5px;padding: 9px 3px;" type="submit">SEARCH</button>
                            </form>   
                        </div> 
                        @else
                        <div style="margin-top:13px;margin-bottom:13px" class="col-12" class="">
                            <form  class="form-inline my-2 my-lg-0 pull-right">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-default" style="border-radius:5px;padding: 9px 3px;" type="submit">SEARCH</button>
                            </form>   
                        </div>
                        @endif
                        @endif
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .top-header-bar -->

        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <div class="site-branding d-flex align-items-center">
                           <a class="d-block" href="{{route('donation.index')}}" rel="home"><img class="d-block" src="{{asset('images/logo.png')}}" alt="logo"></a>
                        </div><!-- .site-branding -->

                        <nav class="site-navigation d-flex justify-content-end align-items-center">
                            <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                                <li class="current-menu-item"><a href="{{route('donation.index')}}">Home</a></li>
                                <li><a href="about.html">About us</a></li>
                                <li><a href="{{route('messages')}}">Messages</a></li>
                                <li><a href="portfolio.html">Gallery</a></li>
                                <li><a href="news.html">News</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                @if (Route::has('login'))
                                        @if (Auth::check())
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            </form>
                                        </li>
                                         @else
                                        <li>
                                            <a href="{{ route('login') }}">Login</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('register') }}">Register</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </nav><!-- .site-navigation -->

                        <div class="hamburger-menu d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div><!-- .hamburger-menu -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .nav-bar -->
    </header><!-- .site-header -->

   

  @yield('content')
    <footer class="site-footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="foot-about">
                            <h2><a class="foot-logo" href="#"><img src="{{asset('images/foot-logo.png')}}" alt=""></a></h2>

                            <p>Lorem ipsum dolor sit amet, con sectetur adipiscing elit. Mauris temp us vestib ulum mauris.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris.Lorem ipsum dolo.</p>

                            <ul class="d-flex flex-wrap align-items-center">
                                <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div><!-- .foot-about -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <h2>Useful Links</h2>

                        <ul>
                            <li><a href="#">Privacy Polticy</a></li>
                            <li><a href="#">Become  a Volunteer</a></li>
                            <li><a href="#">Donate</a></li>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="#">Causes</a></li>
                            <li><a href="#">Portfolio</a></li>
                            <li><a href="#">News</a></li>
                        </ul>
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <div class="foot-latest-news">
                            <h2>Latest News</h2>

                            <ul>
                                <li>
                                    <h3><a href="#">A new cause to help</a></h3>
                                    <div class="posted-date">MArch 12, 2018</div>
                                </li>

                                <li>
                                    <h3><a href="#">We love to help people</a></h3>
                                    <div class="posted-date">MArch 12, 2018</div>
                                </li>

                                <li>
                                    <h3><a href="#">The new ideas for helping</a></h3>
                                    <div class="posted-date">MArch 12, 2018</div>
                                </li>
                            </ul>
                        </div><!-- .foot-latest-news -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <div class="foot-contact">
                            <h2>Contact</h2>

                            <ul>
                                <li><i class="fa fa-phone"></i><span>+45 677 8993000 223</span></li>
                                <li><i class="fa fa-envelope"></i><span>office@template.com</span></li>
                                <li><i class="fa fa-map-marker"></i><span>Main Str. no 45-46, b3, 56832, Los Angeles, CA</span></li>
                            </ul>
                        </div><!-- .foot-contact -->

                        <div class="subscribe-form">
                            <form class="d-flex flex-wrap align-items-center">
                                <input type="email" placeholder="Your email">
                                <input type="submit" value="send">
                            </form><!-- .flex -->
                        </div><!-- .search-widget -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .footer-widgets -->

        <div class="footer-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div><!-- .col-12 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .footer-bar -->
    </footer><!-- .site-footer -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>    <script type='text/javascript' src="{{asset('js/jquery.collapsible.min.js')}}"></script>
    <script type='text/javascript' src="{{secure_asset('js/swiper.min.js')}}"></script>
    <script type='text/javascript' src="{{secure_asset('js/jquery.countdown.min.js')}}"></script>
    <script type='text/javascript' src="{{secure_asset('js/circle-progress.min.js')}}"></script>
    <script type='text/javascript' src="{{secure_asset('js/jquery.countTo.min.js')}}"></script>
    <script type='text/javascript' src="{{secure_asset('js/jquery.barfiller.js')}}"></script>
    <script type='text/javascript' src="{{secure_asset('js/custom.js')}}"></script>
    <script src="{{ secure_asset('js/app.js') }}"></script>

</body>
</html>