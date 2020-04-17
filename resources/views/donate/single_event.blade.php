@extends('layouts.main')
@section('content')
<div class="single-cause">
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>The project</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->
</div>
<div class="single-cause">
    <div class="highlighted-cause">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7 order-2 order-lg-1">
                    <div class="section-heading">
                        <h2 class="entry-title">{{$event->title}}</h2>
                        <p class="text-capitalize">Organizer: {{$event->organizer}}</p>
                    </div><!-- .section-heading -->

                    <div class="entry-content mt-5">
                        <p>{{$event->description}}</p>
                    </div><!-- .entry-content -->
                    <div class="entry-content mt-5">
                        <p><b>Location: </b>{{$event->place}}</p>
                    </div>
                    <div class="entry-content mt-5">
                        <p><b>Time: </b>{{$event->date}}</p>
                    </div>
                
                </div><!-- .col -->

                <div class="col-12 col-lg-5 order-1 order-lg-2">
                    <img src="/images/{{$event->image}}" alt="">
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .highlighted-cause -->
  </div>


   
 
</div>
@endsection

    