@extends('layouts.main')
@section('content')
<div class="single-cause">
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Your Profile</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->
</div>
<div style="padding: 0px 64px;background: #edf3f5;" class="d-flex justify-content-between">
	
	@if($user[0]->role=="user")
	<a class="btn gradient-bg mt-5 btn-info" href="{{route('entrepreneurs.create')}}"><i class="fa fa-building-o" aria-hidden="true"></i>
	Be an entrepreneur</a>
	@else
	<a class="btn btn-default gradient-bg mt-5" href="{{route('entrepreneurs.index')}}">See your donations</a>
	@endif

</div>
<div class="donation-form-wrap">
    <h4 class="mt-5">Change Your Profile</h4>
    {!!Form::model($user,[
        'method'=>'put',
         'route' =>['profile.update',$user[0]->slug],
    ])!!}

    <div class="billing-information d-flex flex-wrap justify-content-between align-items-center">
    	@if(session('status'))
    	<h1 class="alert alert-success">
    		{{session('status')}}
    	</h1>
    	@endif
        <div class="form-group
            {{$errors->has('name')?'has-error':''}}" id="grand_total">
            <div class='input-group date' id=''>
                <input type="text" id="name" name="name" class="form-control" value="{{$user[0]->name}}" placeholder="Enter your name">
                                    
            </div>
                @if($errors->has('name'))
                <span class="help-block">{{$errors->first('name')}}</span>
                 @endif
        </div>
        <div class="form-group
        {{$errors->has('email')?'has-error':''}}" id="email">
            <div class='input-group date' id=''>
                <input type="email" id="email" name="email" value="{{$user[0]->email}}" class="form-control" placeholder="Enter your email address">
                                    
            </div>
            @if($errors->has('email'))
                <span class="help-block">{{$errors->first('email')}}</span>
            @endif
        </div>
        <div class="form-group {{$errors->has('password')?'has-error':''}}">
            <input type="password" value='' placeholder="Enter New Password" class="form-control" name="password">
            @if($errors->has('password'))
            <span class="help-block">{{$errors->first('password')}}</span>
            @endif
        </div>
        <div class="form-group {{$errors->has('password_confirmation')?'has-error':''}}"> 
            <input class="form-control" type="password" name="password_confirmation" placeholder="Re-type New Password">
                @if($errors->has('password'))
                <span class="help-block">{{$errors->first('password')}}</span>
                @endif
        </div> 
    </div>

    
    {!!Form::submit('Update',["class"=>"btn gradient-bg mt-5",'name' => 'submitbutton']);!!}
                        
    {!!Form::close()!!}
</div>
@endsection