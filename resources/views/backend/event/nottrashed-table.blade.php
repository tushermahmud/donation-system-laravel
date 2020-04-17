<table class="table table-bordered">
                    	<thead>
                    		<tr>
                    			<td width="80">Action</td>
                    			<td width="200">Title</td>
                    			<td>Location</td>
                    			<td>Description</td>
                    			<td>Date </td>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($events as $event)
                    		<tr>
                    			<td>
                            {!!Form::model($event, [
                              'method'=>'DELETE',
                              'route' =>['event.destroy',$event->id],
                              
                            ])!!}
                            
                              <a href="{{route('event.edit',$event->id)}}" class=" btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
                              <button type="submit" class=" btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                             
                            {!!Form::close()!!}
                    			</td>
                    			<td>{{substr($event->title,0,20)}}</td>
                    			<td>{{$event->place}}</td>
                    			<td>{{substr($event->title,0,20)}}</td>
                                   <td>{{$event->date}}</td>

                    			@if($event->published_at==0)
                    			<td><span class="label label-warning">Draft</span></td>
                    			@endif
                    			@if($event->published_at==1)
                    			<td><span class="label label-success">Published</span></td>
                    			@endif
                    		</tr>
                    		@endforeach
                    	</tbody>
                    </table>