@extends('layouts.main')
@section('content')
<div class="single-cause">
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>The success</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->
</div>
<div class="single-cause">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if (session('status'))
                <div class="alert alert-success">
                {{ session('status') }}
                </div>
                @endif
            </div><!-- .col -->
            <div  style="dispaly:table;margin:auto;" class="box">
                <div class="box-header">
                    <p>Here is your transaction information</p>
                </div>
                <div class="box-body text-center">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                <p class="card-text">@if(Session::has('transaction_data'))
                                    <p>{{ Session::get('transaction_data')['name'] }}</p>
                                    <p>{{ Session::get('transaction_data')['email'] }}</p>
                                    <p><img style="height:15px;width:10px;margin-right:5px;" src="/images/118px-Taka_(Bengali_letter).svg.png" alt="">{{ Session::get('transaction_data')['grand_total'] }}</p>
                                    
                                @endif</p>
                                
                                <a href="{{url('/')}}" class="btn btn-sm btn-outline-info">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .row -->
    </div><!-- .container -->
</div>
@endsection