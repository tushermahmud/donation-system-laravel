@extends('layouts.main')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="donation-form-wrap">
                    <h2>Make a donation</h2>

                    <h4 class="mt-5">How much do you want to donate?</h4>

                    {!!Form::model($order,[
                    'method'=>'POST',
                    'route' =>'transaction.store',
                    ])!!}
                        

                        <div class="billing-information d-flex flex-wrap justify-content-between align-items-center">
                            <h4 class="w-100 mt-5 mb-3">Billing Information</h4>
                            <div class="form-group
                            {{$errors->has('grand_total')?'has-error':''}}" id="grand_total">
                                <div class='input-group date' id=''>
                                    <input type="number" id="grand_total" name="grand_total" class="form-control" placeholder="Enter your amount">
                                    
                                </div>
                                @if($errors->has('grand_total'))
                                     <span class="help-block">{{$errors->first('grand_total')}}</span>
                                @endif
                            </div>
                            <div class="form-group
                            {{$errors->has('phone_number')?'has-error':''}}" id="grand_total">
                                <div class='input-group date' id=''>
                                    <input type="number" id="phone_number" name="phone_number" class="form-control" placeholder="Enter your Phone Number">
                                    
                                </div>
                                @if($errors->has('phone_number'))
                                     <span class="help-block">{{$errors->first('phone_number')}}</span>
                                @endif
                            </div>
                            
                            <div class="form-group {{$errors->has('name')?'has-error':''}}">
                                <input type="text" placeholder="Name" class="form-control" name="name">
                                @if($errors->has('name'))
                                <span class="help-block">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('email')?'has-error':''}}"> 
                                <input class="form-control" type="email" name="email" placeholder="E-mail">
                                @if($errors->has('email'))
                                    <span class="help-block">{{$errors->first('email')}}</span>
                                @endif
                            </div> 
                            <div class="form-group {{$errors->has('address')?'has-error':''}}">
                                <input class="form-control" type="text" placeholder="Address" name="address">
                                @if($errors->has('address'))
                                    <span class="help-block">{{$errors->first('address')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('city')?'has-error':''}}">
                                <input class="form-control" accept=" " type="text" placeholder="City" name="city">
                                 @if($errors->has('city'))
                                    <span class="help-block">{{$errors->first('city')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('post_code')?'has-error':''}}">
                                <input class="form-control" type="number" placeholder="Postcode" name="post_code">
                                @if($errors->has('post_code'))
                                    <span class="help-block">{{$errors->first('post_code')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('country')?'has-error':''}}">
                                <input class="form-control" type="text" placeholder="Country" name="country">
                                @if($errors->has('country'))
                                    <span class="help-block">{{$errors->first('country')}}</span>
                                @endif
                            </div>
                            <div class="form-group
                            {{$errors->has('currency')?'has-error':''}}" id="grand_total">
                                <div class="input-group d-flex  justify-content-between">
                                    <div>
                                    <input type="radio" id="bdt" name="currency" value="BDT" >BDT
                                    </div>
                                    <div>
                                    <input type="radio" name="currency" value="USD">USD
                                    </div>
                                    <div>
                                    <input type="radio" name="currency" value="EUR">EUR
                                    </div>
                                </div>
                                @if($errors->has('currency'))
                                     <span class="help-block">{{$errors->first('currency')}}</span>
                                @endif
                            </div>
                        </div>
                        {!!Form::submit('Donate Now',["class"=>"btn gradient-bg mt-5",'name' => 'submitbutton']);!!}
                        
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
    @endsection