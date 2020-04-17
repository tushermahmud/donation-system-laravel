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
      <a href="?status=published"> Published ({{$counts['published']}})</a> |
      <a href="?status=draft"> Draft ({{$counts['draft']}})</a>
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
            <a style="border-radius:0px;margin-bottom:50px;" class="btn btn-default gradient-bg mt-5" href="{{route('entrepreneurs.create')}}"><i class="fa fa-plus"></i>Add Project</a>
            <table class="table">
              <thead style="background-color:#ff5a00" class="thead-dark">
                <tr>
                  <th style="background-color:#ff5a00;border-color:#ff5a00" scope="col">Title</th>
                  <th style="background-color:#ff5a00;border-color:#ff5a00" scope="col">Body</th>
                  <th style="background-color:#ff5a00;border-color:#ff5a00" scope="col">Donation Needed</th>
                  <th style="background-color:#ff5a00;border-color:#ff5a00" scope="col">Donation Collected</th>
                  <th style="background-color:#ff5a00;border-color:#ff5a00" scope="col">Actions</th>
                  <th style="background-color:#ff5a00;border-color:#ff5a00" scope="col">Status</th>
                  <th style="background-color:#ff5a00;border-color:#ff5a00" scope="col">News</th>
                </tr>
              </thead>
              <tbody>
                @foreach($donation_informations as $donation_information)
                @if($onlyTrashed==false)
                <tr>
                  <td>{{substr($donation_information->title,0,20)}}{{'....'}}</td>
                  <td>{{substr($donation_information->body,0,40)}}{{'....'}}</td>
                  <td>
                    <img style="height:15px;width:10px;margin-right:5px;" src="/images/118px-Taka_(Bengali_letter).svg.png" alt="">{{$donation_information->donation_needed}}
                  </td>
                  <td>
                    <img style="height:15px;width:10px;margin-right:5px;" src="/images/118px-Taka_(Bengali_letter).svg.png" alt="">{{$donation_information->total_collection}}
                  </td>
                  <td class="d-flex">
                    <a style="padding:5px 5px;" href="{{route('entrepreneurs.edit',$donation_information->id)}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i>
                    </a>
                    {!!Form::model($donation_information, [
                              'method'=>'DELETE',
                              'route' =>['entrepreneurs.destroy',$donation_information->id],
                              
                    ])!!}
                    <button style="padding:5px 5px;background-color:red" type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></a>
                  </td>
                  @if($donation_information->published_at==1)
                  <td><span class="label label-success">Published</span></td>
                  @else
                  <td><span class="label label-warning">Draft</span></td>
                  @endif
                  <td><a style="padding:5px 10px" class="btn btn-xs btn-info" href="{{route('index',$donation_information->id)}}">latest</a></td>
                    {!!Form::close()!!}
                </tr>
                @else
                <tr>
                  <td>{{substr($donation_information->title,0,20)}}{{'....'}}</td>
                  <td>{{substr($donation_information->body,0,40)}}{{'....'}}</td>
                  <td>
                    <img style="height:15px;width:10px;margin-right:5px;" src="/images/118px-Taka_(Bengali_letter).svg.png" alt="">{{$donation_information->donation_needed}}
                  </td>
                  <td>
                    <img style="height:15px;width:10px;margin-right:5px;" src="/images/118px-Taka_(Bengali_letter).svg.png" alt="">{{$donation_information->total_collection}}
                  </td>
                  <td class="d-flex">
                    {!!Form::model($donation_information, [
                              'method'=>'PUT',
                              'route' =>['entrepreneurs.restore',$donation_information->id],
                              
                    ])!!}
                    <button style="padding:5px 5px" title="Restore" type="submit" class=" btn btn-xs btn-default"><i class="fa fa-refresh"></i></button></a>
                  </td>
                  @if($donation_information->deleted_at!=null)
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
                   
                    {{$donation_informations->appends(Request::query())->render()}}
                   
                </div>
                
                <div class="pull-right">{{$donationCount}}{{str_plural(' Item',$donationCount)}}</div>
            </div>
        </div>
    </div>
</div>
@endsection