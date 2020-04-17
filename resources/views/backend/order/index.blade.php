@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Donations
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Orders</a></li>
        <li><a href="{{route('donations.index')}}">Orders</a></li>
        <li class="active">Display all Orders</li>
      </ol>
  </section>
  <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header clearfix">
               <div class="pull-right">
                  <a href="?status=all">All ({{$counts['all']}})</a>|
                  <a href="?status=completed"> Completed ({{$counts['completed']}})</a> |
                  <a href="?status=processing"> Processing ({{$counts['processing']}})</a> |
                  <a href="?status=failed"> Failed ({{$counts['failed']}})</a> 
                  
                </div>
                
              </div>
              <!-- /.box-header -->
              <div class="box-body ">
                
                @if(session('status'))
                <div class="alert alert-success d-block">
                  <h3 style="" class="text-uppercase font-weight-bold text-center">{{session('status')}}</h3>
                </div>
                @elseif(session('thrashed'))
                <div class="alert alert-danger d-block">
                  <h3 style="" class="text-uppercase font-weight-bold text-center">{{session('thrashed')}}</h3>
                </div>
                @elseif(session('trash'))
                <div class="alert alert-success d-block">
                  
                  <?php list($message,$id) = session('trash');?>
                  {!!Form::open(['method'=>'PUT',
                    'route' =>['blog.restore',$id],
                  ])!!}
                  <h3 style="" class="text-uppercase font-weight-bold text-center">{{$message}}
                  
                  <button type="submit" class="btn btn-lg btn-warning">Undo</button>
                  {!!Form::close()!!}
      
                  
                </div>
                @endif
                @if($ordersCount==0)
                  <div class="alert alert-danger">
                    <h3 style="" class="text-uppercase font-weight-bold">No record found !</h3>
                  </div>
                @else
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <td width="120">Action</td>
                          <td width="300">Orders ID</td>
                          <td>Orders Amount</td>
                          <td>Orders Date</td>
                          <td>Orders Currency </td>
                          <td>Orders Status</td>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($orders as $order)
                        <tr>
                          
                          
                          <td>
                            {!!Form::model($order, [
                              'method'=>'put',
                              'route' =>['orders.update',$order->order_id],
                              
                            ])!!}

                            @if($order->order_status=="processing")
                            <button type="submit" name="complete" value="published" class="btn btn-xs btn-default">Complete</button>
                            
                            @else
                           	<button type="submit" name="complete" value="published" class="btn btn-xs btn-default disabled" disabled >Complete</button>
                            @endif
                          </td>
                         
                            {!!Form::close()!!}
                          
                          <td>#{{ $order->order_id}}</td>
                          <td>{{$order->grand_total}}</td>
                          <td>{{$order->created_at}}</td>
                          <td>{{$order->currency}}</td>
                            @if($order->order_status=="processing")
                            <td><span class="label label-warning">Processing</span></td>
                            @endif
                            @if($order->order_status=="failed")
                            <td><span class="label label-danger">Failed</span></td>
                            @endif
                            @if($order->order_status=="completed")
                            <td><span class="label label-success">Completed</span></td>
                            @endif
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                <div class="pull-left">
                  <ul class="pagination no-margin">
                    {{$orders->appends(Request::query())->render()}}
                  </ul>
                </div>
                <div class="pull-right">{{$ordersCount}}{{str_plural(' Item',$ordersCount)}}</div>
              </div>
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- ./row -->
    </section>
  </div>
  @endsection