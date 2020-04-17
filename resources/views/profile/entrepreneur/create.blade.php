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
  

</div>
<div class="donation-form-wrap">
    <h4 class="mt-5">Change Your Profile</h4>
    {!!Form::model($donation,[
        'method'=>'post',
         'route' =>['entrepreneurs.store'],
         'files' =>true
    ])!!}

    <div class="billing-information d-flex flex-wrap justify-content-between align-items-center">
      @if(session('status'))
      <h1 class="alert alert-success">
        {{session('status')}}
      </h1>
      @endif
        <div class="form-group
            {{$errors->has('title')?'has-error':''}}" id="grand_total">
            <div class='input-group date' id=''>
                <input type="text" id="name" name="title" class="form-control" placeholder="Enter The Title">
                                    
            </div>
                @if($errors->has('title'))
                <span class="help-block">{{$errors->first('title')}}</span>
                 @endif
        </div>
        <div class="form-group
        {{$errors->has('donation_needed')?'has-error':''}}" id="email">
            <div class='input-group date' id=''>
                <input type="number" id="email" name="donation_needed" class="form-control" placeholder="The Donation You Need">
                                    
            </div>
            @if($errors->has('donation_needed'))
                <span class="help-block">{{$errors->first('donation_needed')}}</span>
            @endif
        </div>
        <div class="form-group {{$errors->has('total_collection')?'has-error':''}}">
            <input type="number"  placeholder="The Donation You Contributed" class="form-control" name="total_collection">
            @if($errors->has('total_collection'))
            <span class="help-block">{{$errors->first('total_collection')}}</span>
            @endif
        </div>
        
    </div>
    <div class="billing-information d-flex flex-wrap justify-content-between align-items-center">
        <div class="form-group {{$errors->has('body')?'has-error':''}}"> 
            <textarea style="margin-top:28px" class="form-control" name="body" placeholder="body"></textarea>
                @if($errors->has('body'))
                <span class="help-block">{{$errors->first('body')}}</span>
                @endif
        </div> 
        <div class="form-group {{$errors->has('description')?'has-error':''}}"> 
            <textarea style="margin-top:28px" class="form-control" name="description" placeholder="Description"></textarea>
                @if($errors->has('description'))
                <span class="help-block">{{$errors->first('description')}}</span>
                @endif
        </div>
        <div class="form-group {{$errors->has('additional')?'has-error':''}}"> 
            <textarea style="margin-top:28px" class="form-control" name="additional" placeholder="Additional"></textarea>
                @if($errors->has('additional'))
                <span class="help-block">{{$errors->first('additional')}}</span>
                @endif
        </div>
        <div class="form-group {{$errors->has('goals')?'has-error':''}}"> 
            <textarea style="margin-top:28px" class="form-control" name="goals" placeholder="Goals"></textarea>
                @if($errors->has('goals'))
                <span class="help-block">{{$errors->first('goals')}}</span>
                @endif
        </div>
        <div class=" form-group {{$errors->has('image')?'has-error':''}}">
                {!!Form::label('Choose your image');!!}
                <br>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    
                  <div>
                      
                      {!!Form::file('image',null,['class'=>"form-control-file"]);!!}
                      
                    
                  </div>

                
                @if($errors->has('image'))
                  <span class="help-block">{{$errors->first('image')}}</span>
                @endif
                </div>
                <hr>
                
              </div>
    </div>
    {!!Form::submit('Create Project',["class"=>"btn gradient-bg mt-5",'name' => 'submitbutton']);!!}
                        
    {!!Form::close()!!}
</div>
@endsection