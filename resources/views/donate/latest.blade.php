@extends('layouts.main')
@section('content')


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
				<div class="col-md-12">
					<h3 class="alert alert-info">Latest News: {{$LatestCount}}</h3>
				</div>
			</div>
            <div class="row">
                @foreach($latests as $latest)

                <div class="col-md-4">
                    <div class="cause-wrap">
                        <figure class="m-0">
                            <img src="/images/{{$latest->image}}" alt="">
                        </figure>
								
                        <div class="cause-content-wrap">
                            <header class="entry-header d-flex">
                               	<h3 class="entry-title w-100 m-0"><a href="{{route('single.donation.show',$latest->slug)}}">
                                {{substr($latest->title,0,26)}}</a></h3>
                           	</header><!-- .entry-header -->
                                       
                            <div class="entry-content">
                                <p class="m-0">{{substr($latest->body,0,100)}}</p>
                            </div><!-- .entry-content -->
                        </div><!-- .cause-content-wrap -->
                    </div><!-- .cause-wrap -->

                </div><!-- .swiper-slide -->
                          @endforeach
            </div>
            <div class="row">
					<div class="col-md-12">
						<nav aria-label="Page navigation example ">
  								{{$latests->links()}}
						</nav>

					</div>

			</div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .our-causes -->

   

@endsection