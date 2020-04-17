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
                    		'style'=>'display:inline-block',
                            'method'=>'PUT',
                            'route' =>['event.restore',$event->id],
                              
                            ])!!}

                            <button title="Restore" type="submit" class="btn btn-xs btn-default"><i class="fa fa-refresh"></i></button>
                            {!!Form::close()!!}
                            {!!Form::model($event, [
                            'style'=>'display:inline-block',
                              'method'=>'DELETE',
                              'route' =>['event.force-destroy',$event->id],
                              
                            ])!!}
                    		<button title="Destroy Permanantly" class="btn btn-xs btn-danger" onclick="return confirm('you are about to delete the$event premanantly. Are you sure?')"><i class="fa fa-trash"></i></button>
                    				
                            {!!Form::close()!!}
                           
                    			</td>
                    			<td>{{substr($event->title,0,20)}}</td>
                                <td>{{$event->place}}</td>
                                <td>{{substr($event->title,0,20)}}</td>
                                   <td>{{$event->date}}</td>
                    			
                    		</tr>
                    		@endforeach
                    	</tbody>
                    </table>