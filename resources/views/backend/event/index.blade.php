@extends('backend.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Event
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('event.index')}}">Events</a></li>
        <li class="active">Display all Events</li>
      </ol>
  </section>
  <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header clearfix">
               <div style="margin-bottom:20px ;display:block"class="pull-left">
                  <a class="btn btn-success" href="{{route('event.create')}}">Add New Event</a>
                </div>

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
                @elseif(session('trash'))
                <div class="alert alert-success d-block">
                  
                  <?php list($message,$id) = session('trash');?>
                  {!!Form::open(['method'=>'PUT',
                    'route' =>['event.restore',$id],
                  ])!!}
                  <h3 style="" class="text-uppercase font-weight-bold text-center">{{$message}}
                  
                  <button type="submit" class="btn btn-lg btn-warning">Undo</button>
                  {!!Form::close()!!}
      
                  
                </div>
                @endif
                @if($events->count()==0)
                  <div class="alert alert-danger">
                    <h3 style="" class="text-uppercase font-weight-bold">No record found !</h3>
                  </div>
                @else
                    @if($onlyTrashed==true)
                      @include('backend.event.trashed-table')
                    @else
                      @include('backend.event.nottrashed-table')
                    @endif
                @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                <div class="pull-left">
                  <ul class="pagination no-margin">
                    {{$events->appends(Request::query())->render()}}
                  </ul>
                </div>
                <div class="pull-right">{{$eventCount}}{{str_plural(' Item',$eventCount)}}</div>
              </div>
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- ./row -->
    </section>
  </div>
@endsection