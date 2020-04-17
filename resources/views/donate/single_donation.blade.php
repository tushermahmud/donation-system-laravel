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
                        <h2 class="entry-title">{{$donation->title}}</h2>
                        <p class="text-capitalize">Entrepreneur: {{$donation->entrepreneurs->name}}</p>
                    </div><!-- .section-heading -->

                    <div class="entry-content mt-5">
                        <p>{{$donation->body}}</p>
                    </div><!-- .entry-content -->

                    <div class="fund-raised w-100 mt-5">
                        <p class="font-weight-bold">
                                      <?php $percentage=($donation->total_collection*100)/$donation->donation_needed;
                                        echo floor($percentage).'%';?>
                                        </p>
                                          <div class="progress custom-progress-success">
                                      <span class="progress-bar bg-primary" role="progressbar" style="width:<?php echo $percentage.'%';?>;background:#f86f2d;" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></span>
                                    </div><!-- .fund-raised-bar -->

                        <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                            <div class="fund-raised-total mt-4">
                                Raised:{{$donation->total_collection}}
                            </div><!-- .fund-raised-total -->

                            <div class="fund-raised-goal mt-4">
                                Goal: {{$donation->donation_needed}}
                            </div><!-- .fund-raised-goal -->
                        </div><!-- .fund-raised-details -->
                    </div><!-- .fund-raised -->

                    <div class="entry-footer mt-5">
                        <a href="{{route('transaction',$donation->slug)}}" class="btn gradient-bg">Donate Now</a>
                    </div>
                    <div class="entry-footer mt-5">
                        <a href="{{route('latestNews',$donation->id)}}" class="btn gradient-bg">Latest News</a>
                    </div><!-- .entry-footer -->
                </div><!-- .col -->

                <div class="col-12 col-lg-5 order-1 order-lg-2">
                    <img src="{{asset('images/oshomah.jpg')}}" alt="">
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .highlighted-cause -->
  </div>

    <div class="short-content-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="short-content">
                        <h3 class="entry-title">Description</h3>

                        <p>{{$donation->description}}</p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="short-content">
                        <h3 class="entry-title">Additional Information</h3>

                        <p>{{$donation->additional}}</p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="short-content">
                        <h3 class="entry-title">Our Goal</h3>

                        <p>{{$donation->goals}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="billing-information">
                    
                    <ul class="comment-section">
                        <h4 class="w-100 mt-5 mb-3">Your Comments <?php echo " "."(". $commentsCount.")"." ";?></h4>

                        <?php $i=1;?>
                        @foreach($comments as $comment)
                        
                        @if($comment->entrepreneurs->id==$donation->entrepreneurs->id)
                        <li class="comment author-comment">

                            <div class="info">
                                <a href="#">{{$comment->entrepreneurs->name}}</a>
                                <span>{{$comment->created_at->diffForHumans()}}</span>
                            </div>

                            <a class="avatar" href="#">
                                <img src="/images/avatar_author.jpg" width="35" alt="Profile Avatar" title="Jack Smith" />
                            </a>

                            <p>{{$comment->body}}</p>
                        </li>
                        <?php $i=$i+1;?>
                        @else
                        <li class="comment user-comment">

                            <div class="info">
                                <a href="#">{{$comment->entrepreneurs->name}}</a>
                                <span>{{$comment->created_at->diffForHumans()}}</span>
                            </div>

                            <a class="avatar" href="#">
                                <img src="/images/avatar_user_1.jpg" width="35" alt="Profile Avatar" title="Anie Silverston" />
                            </a>

                            <p>{{$comment->body}}</p>

                        </li>

                        
                        <?php $i=$i+1;?>
                        @endif
                        @endforeach

                        @if (Route::has('login'))
                        @if(auth::check())
                        <li class="write-new">
                            {{$comments->appends(Request::query())->render()}}
                           {!!Form::model($comments,[
                                    'method'=>'POST',
                                    'route' =>['comment.create',$donation->id],
                                ])!!}
                                <div style="width:100%" class="form-group
                                {{$errors->has('body')?'has-error':''}}" id="grand_total">

                                <textarea placeholder="Write your comment here" name="body"></textarea>
                                @if($errors->has('body'))
                                    <span class="help-block">{{$errors->first('body')}}</span>
                                @endif
                            </div>

                                <div>
                                    <img src="/images/avatar_user_2.jpg" width="35" alt="Profile of Bradley Jones" title="Bradley Jones" />
                                </div>
                                
                            
                                {!!Form::submit('Comment Here!',["class"=>"btn gradient-bg mt-5",'name' => 'submitbutton']);!!}

                            {!!Form::close()!!}
                        </li>
                        
                        @else
                        <h3 class>Please <a href="{{ route('register') }}">register</a>  or <a href="{{ route('login') }}">login</a> to leave a comment</h3>  
                        @endif
                        @endif
                    </ul>
                </div>   
            </div>
        </div>
    </div>
 
</div>
@endsection

    