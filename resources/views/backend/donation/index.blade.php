@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Donations
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Donations</a></li>
        <li><a href="{{route('donations.index')}}">Donations</a></li>
        <li class="active">Display all Donations</li>
      </ol>
  </section>
  <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header clearfix">
               <div class="pull-right">
                  <a href="?status=all">All ({{$counts['all']}})</a>|
                  <a href="?status=trash"> Trash ({{$counts['trashed']}})</a> |
                  <a href="?status=published"> Published ({{$counts['published']}})</a> |
                  <a href="?status=draft"> Draft ({{$counts['draft']}})</a> 
                  
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
                @if($donationsCount==0)
                  <div class="alert alert-danger">
                    <h3 style="" class="text-uppercase font-weight-bold">No record found !</h3>
                  </div>
                @else
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <td width="120">Action</td>
                          <td width="300">Title</td>
                          <td>Entrepreneur</td>
                          <td>Donations Needed</td>
                          <td>Donations Collected </td>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($donations as $donation)
                        <tr>
                          
                          @if($onlyTrashed==false)
                          <td>
                            {!!Form::model($donation, [
                              'method'=>'put',
                              'route' =>['donations.update',$donation->id],
                              
                            ])!!}

                            @if($donation->published_at==0)
                            <button type="submit" name="publish" value="published" class="btn btn-xs btn-default">Publish</button>
                            
                            @elseif($donation->published_at==1)
                            <button type="submit" name="publish" value="unpublished" class="btn btn-xs btn-danger">Unublish</button>
                            @endif
                          </td>
                         
                            {!!Form::close()!!}
                          @else
                          <td>
                            {!!Form::model($donation, [
                              'method'=>'Delete',
                              'route' =>['donations.forceDelete',$donation->id],
                              
                            ])!!}
                          <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                            {!!Form::close()!!}
                           
                          </td>
                           @endif
                          <td>{{$donation->title}}</td>
                          <td>{{$donation->entrepreneurs->name}}</td>
                          <td>{{$donation->donation_needed}}</td>
                          <td>{{$donation->total_collection}}</td>
                            @if($donation->published_at==0)
                            <td><span class="label label-warning">Draft</span></td>
                            @endif
                            @if($donation->published_at==1)
                            <td><span class="label label-success">Published</span></td>
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
                    {{$donations->appends(Request::query())->render()}}
                  </ul>
                </div>
                <div class="pull-right">{{$donationsCount}}{{str_plural(' Item',$donationsCount)}}</div>
              </div>
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- ./row -->
    </section>
  </div>
  @endsection