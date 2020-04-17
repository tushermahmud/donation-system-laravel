@extends('layouts.main')
@section('content')
<div class="single-cause">
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Your Projects</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <a href="?status=all">All ({{$counts['all']}})</a>|
      <a href="?status=trash"> Trash ({{$counts['trashed']}})</a> |
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      @if(session('status'))
      <h3 class="alert alert-info">
        {{session('status')}}
        
      </h3>
      @endif
    </div>
  </div>  
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a style="border-radius:0px;margin-bottom:50px;" class="btn btn-default gradient-bg mt-5" href="{{route('latestCreate',$id)}}"><i class="fa fa-plus"></i>Add Latest News</a>
            <table class="table">
              <thead style="background-color:#ff5a00" class="thead-dark">
                <tr>
                  <th style="background-color:#ff5a00;border-color:#ff5a00" scope="col">Title</th>
                  <th style="background-color:#ff5a00;border-color:#ff5a00" scope="col">Body</th>
                  <th style="background-color:#ff5a00;border-color:#ff5a00" scope="col">Uploded At</th>
                  <th style="background-color:#ff5a00;border-color:#ff5a00" scope="col">Actions</th>
                  <th style="background-color:#ff5a00;border-color:#ff5a00" scope="col">Status</th>
                </tr>
              </thead>
              <tbody>

                @foreach($latest_informations as $latest_information)
                @if($onlyTrashed==false)
                <tr>
                  <td>{{substr($latest_information->title,0,20)}}{{'....'}}</td>
                  <td>{{substr($latest_information->body,0,40)}}{{'....'}}</td>
                  <td>{{$latest_information->created_at}}</td>
                  
                  <td class="d-flex">
                    <a style="padding:5px 5px;" href="{{route('latest.edit',$latest_information->id)}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i>
                    </a>
                    {!!Form::model($latest_information, [
                              'method'=>'DELETE',
                              'route' =>['latest.destroy',$latest_information->id],
                              
                    ])!!}
                    <button style="padding:5px 5px;background-color:red" type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                  @if($latest_information->deleted_at!=null)
                  <td><span class="label label-danger">Trashed</span></td>
                  @else
                  <td><span class="label label-success">Published</span></td>
                  @endif
                    {!!Form::close()!!}
                </tr>
                @else
                <tr>
                  <td>{{substr($latest_information->title,0,20)}}{{'....'}}</td>
                  <td>{{substr($latest_information->body,0,40)}}{{'....'}}</td>
                  <td>{{$latest_information->created_at}}</td>
                 
                  <td class="d-flex">
                    {!!Form::model($latest_information, [
                              'method'=>'PUT',
                              'route' =>['latest.restore',$latest_information->id],
                              
                    ])!!}
                    <button style="padding:5px 5px" title="Restore" type="submit" class=" btn btn-xs btn-default"><i class="fa fa-refresh"></i></button></a>
                  </td>
                  @if($latest_information->deleted_at!=null)
                  <td><span class="label label-danger">Trashed</span></td>
                  @endif
                    {!!Form::close()!!}
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
            <div class="footer">
                <div class="pull-left">
                   
                    {{$latest_informations->appends(Request::query())->render()}}
                   
                </div>
                
                <div class="pull-right">{{$latestCount}}{{str_plural(' Item',$latestCount)}}</div>
            </div>
        </div>
    </div>
</div>
@endsection