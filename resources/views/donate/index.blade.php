@extends('layouts.main')
@section('content')
  @include('layouts.slider')
    <div class="home-page-icon-boxes">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box active">
                        <figure class="d-flex justify-content-center">
                            <img src="/images/hands-gray.png" alt="">
                            <img src="/images/hands-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">Become a Volunteer</h3>
                        </header>

                        <div class="entry-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris quis aliquam. </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <figure class="d-flex justify-content-center">
                            <img src="/images/donation-gray.png" alt="">
                            <img src="/images/donation-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">Dance & Music</h3>
                        </header>

                        <div class="entry-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris quis aliquam. </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <figure class="d-flex justify-content-center">
                            <img src="/images/charity-gray.png" alt="">
                            <img src="/images/charity-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">Online Conference</h3>
                        </header>

                        <div class="entry-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris quis aliquam. </p>
                        </div>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->

    <div class="home-page-welcome">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="welcome-content">
                        <header class="entry-header">
                            <h2 class="entry-title">Wellcome to our Charity</h2>
                        </header><!-- .entry-header -->

                        <div class="entry-content mt-5">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris quis aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestibulum mauris quis aliquam. Integer accumsan sodales odio, id tempus velit ullamcorper id. Quisque at erat eu libero consequat tempus. Quisque molestie convallis tempus. Ut semper purus metus, a euismod sapien sodales ac. Duis viverra eleifend fermentum.</p>
                        </div><!-- .entry-content -->

                        <div class="entry-footer mt-5">
                            <a href="#" class="btn gradient-bg mr-2">Read More</a>
                        </div><!-- .entry-footer -->
                    </div><!-- .welcome-content -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 mt-4 order-1 order-lg-2">
                    <img src="/images/welcome.jpg" alt="welcome">
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->

    <div class="home-page-events">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="upcoming-events">
                        <div class="section-heading">
                            <h2 class="entry-title">Upcoming Events</h2>
                        </div><!-- .section-heading -->
                        @foreach($events as $event)

                        <div class="event-wrap d-flex flex-wrap justify-content-between">
                            <figure class="m-0">
                                <img src="/images/{{$event->image}}" alt="">
                            </figure>

                            <div class="event-content-wrap">
                                <header class="entry-header d-flex flex-wrap align-items-center">
                                    <h3 class="entry-title w-100 m-0"><a href="{{route('show_event',$event->slug)}}">{{$event->title}}</a></h3>

                                    <div class="posted-date">
                                        <a href="#">{{$event->date}}</a>
                                    </div><!-- .posted-date -->

                                    <div class="cats-links">
                                        <a href="#">{{substr($event->place,0,20)}}</a>
                                    </div>
                                </header>

                                <div class="entry-content">
                                    <p class="m-0">{{substr($event->description,0,80)}}</p>
                                </div>

                                <div class="entry-footer">
                                    <a href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                        @endforeach<!-- .event-wrap -->
                    </div><!-- .upcoming-events -->

                </div><!-- .col -->

                <div class="col-12 col-lg-6">
                    <div class="featured-cause">
                        <div class="section-heading">
                            <h2 class="entry-title">Featured Cause</h2>
                        </div><!-- .section-heading -->

                        <div class="cause-wrap d-flex flex-wrap justify-content-between">
                            <figure class="m-0">
                                <img src="/images/featured-causes.jpg" alt="">
                            </figure>

                            <div class="cause-content-wrap">
                                <header class="entry-header d-flex flex-wrap align-items-center">
                                    <h3 class="entry-title w-100 m-0"><a href="#">Fundraiser for Kids</a></h3>

                                    <div class="posted-date">
                                        <a href="#">Aug 25, 2018 </a>
                                    </div><!-- .posted-date -->

                                    <div class="cats-links">
                                        <a href="#">Ball Room New York</a>
                                    </div><!-- .cats-links -->
                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris. Lorem ipsum dolor sit amet, consectetur.</p>
                                </div><!-- .entry-content -->

                                <div class="entry-footer mt-5">
                                    <a href="#" class="btn gradient-bg mr-2">Donate Now</a>
                                </div><!-- .entry-footer -->
                            </div><!-- .cause-content-wrap -->

                            <div class="fund-raised w-100">
                                <div class="featured-fund-raised-bar barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div><!-- .tipWrap -->

                                    <span class="fill" data-percentage="83"></span>
                                </div><!-- .fund-raised-bar -->

                                <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="fund-raised-total mt-4">
                                        Raised: $56 880
                                    </div><!-- .fund-raised-total -->

                                    <div class="fund-raised-goal mt-4">
                                        Goal: $70 000
                                    </div><!-- .fund-raised-goal -->
                                </div><!-- .fund-raised-details -->
                            </div><!-- .fund-raised -->
                        </div><!-- .cause-wrap -->
                    </div><!-- .featured-cause -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-events -->

    <div class="our-causes">
        <div class="container">
            <div class="row">
                <div class="coL-12">
                    <div class="section-heading">
                        <h2 class="entry-title">Our Projects</h2>
                    </div><!-- .section-heading -->
                </div><!-- .col -->
            </div><!-- .row -->

            <div class="row">
                <div class="col-12">
                  @if(isset($name))
                  <div class="alert alert-info">
                    <h3>Entrepreneur: <strong class="text-capitalize">{{$name}}</strong></h3>
                  </div>
                  @endif
                    <div class="swiper-container causes-slider">
                        <div class="swiper-wrapper">

                            @foreach($donations as $donation)

                            <div class="swiper-slide">
                                <div class="cause-wrap">
                                    <figure class="m-0">
                                        <img src="/images/{{$donation->image}}" alt="">

                                        <div class="figure-overlay d-flex justify-content-center align-items-center position-absolute w-100 h-100">
                                            <a href="{{route('transaction',$donation->slug)}}" class="btn gradient-bg mr-2">Donate Now</a>
                                        </div><!-- .figure-overlay -->
                                    </figure>

                                    <div class="cause-content-wrap">
                                        <header class="entry-header d-flex flex-wrap align-items-center">
                                            <h3 class="entry-title w-100 m-0"><a href="{{route('single.donation.show',$donation->slug)}}">{{substr($donation->title,0,26)}}</a></h3>
                                        </header><!-- .entry-header -->
                                        <p style="font-size:14px;" class=" text-capitalize"><a href="{{route('entrepreneur',$donation->entrepreneurs->slug)}}">Entrepreneur: {{ $donation->entrepreneurs->name }}</a></p>
                                        <div class="entry-content">
                                            <p class="m-0">{{substr($donation->body,0,100)}}</p>
                                        </div><!-- .entry-content -->

                                        <div class="fund-raised w-100">
                                          
                                        <p class="font-weight-bold">
                                      <?php $percentage=($donation->total_collection*100)/$donation->donation_needed;
                                        echo floor($percentage).'%';?>
                                        </p>
                                          <div class="progress custom-progress-success">
                                      <span class="progress-bar bg-primary" role="progressbar" style="width:<?php echo $percentage.'%';?>;background:#f86f2d;" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></span>
                                    </div>

                                            <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="fund-raised-total mt-4">
                                                    Raised: <img style="height:15px;width:10px;margin-right:5px;" src="/images/118px-Taka_(Bengali_letter).svg.png" alt="">{{$donation->total_collection}}
                                                </div><!-- .fund-raised-total -->

                                                <div class="fund-raised-goal mt-4">
                                                    Goal: <img style="height:15px;width:10px;margin-right:5px;" src="/images/118px-Taka_(Bengali_letter).svg.png" alt="">{{$donation->donation_needed}}
                                                </div><!-- .fund-raised-goal -->
                                            </div><!-- .fund-raised-details -->
                                        </div><!-- .fund-raised -->
                                    </div><!-- .cause-content-wrap -->
                                </div><!-- .cause-wrap -->
                            </div><!-- .swiper-slide -->
                          @endforeach
                        </div><!-- .swiper-wrapper -->

                    </div><!-- .swiper-container -->

                    <!-- Add Arrows -->
                    <div class="swiper-button-next flex justify-content-center align-items-center">
                        <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1171 960q0 13-10 23l-466 466q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l393-393-393-393q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l466 466q10 10 10 23z"/></svg></span>
                    </div>

                    <div class="swiper-button-prev flex justify-content-center align-items-center">
                        <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1203 544q0 13-10 23l-393 393 393 393q10 10 10 23t-10 23l-50 50q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg></span>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .our-causes -->

    <div class="home-page-limestone">
        <div class="container">
            <div class="row align-items-end">
                <div class="coL-12 col-lg-6">
                    <div class="section-heading">
                        <h2 class="entry-title">We love to help all the children that have problems in the world. After 15 years we have many goals achieved.</h2>

                        <p class="mt-5">Dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris quis aliquam. Lorem ipsum dolor sit amet.</p>
                    </div><!-- .section-heading -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6">
                    <div class="milestones d-flex flex-wrap justify-content-between">
                        <div class="col-12 col-sm-4 mt-5 mt-lg-0">
                            <div class="counter-box">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="{{asset('images/teamwork.png')}}" alt="">
                                </div>

                                <div class="d-flex justify-content-center align-items-baseline">
                                    <div class="start-counter" data-to="120" data-speed="2000"></div>
                                    <div class="counter-k">K</div>
                                </div>

                                <h3 class="entry-title">Children helped</h3><!-- entry-title -->
                            </div><!-- counter-box -->
                        </div><!-- .col -->

                        <div class="col-12 col-sm-4 mt-5 mt-lg-0">
                            <div class="counter-box">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="images/donation.png" alt="">
                                </div>

                                <div class="d-flex justify-content-center align-items-baseline">
                                    <div class="start-counter" data-to="79" data-speed="2000"></div>
                                </div>

                                <h3 class="entry-title">Water wells</h3><!-- entry-title -->
                            </div><!-- counter-box -->
                        </div><!-- .col -->

                        <div class="col-12 col-sm-4 mt-5 mt-lg-0">
                            <div class="counter-box">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="images/dove.png" alt="">
                                </div>

                                <div class="d-flex justify-content-center align-items-baseline">
                                    <div class="start-counter" data-to="253" data-speed="2000"></div>
                                </div>

                                <h3 class="entry-title">Volunteeres</h3><!-- entry-title -->
                            </div><!-- counter-box -->
                        </div><!-- .col -->
                    </div><!-- .milestones -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .our-causes -->

@endsection