<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use App\User;

class EventController extends Controller
{
    protected $uploadPath;
    public function __construct(){
        $this->uploadPath=public_path('images');
        $this->middleware('auth:admin');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $onlyTrashed=null;
        if($request->get('status')&&$request->get('status')=='trash'){
            $events=Event::onlyTrashed()->orderBy('created_at','desc')->paginate(5);
            $onlyTrashed=True;
            $eventCount=Event::onlyTrashed()->count();
        }
        elseif($request->get('status')&&$request->get('status')=='published'){
            $events=Event::where('published_at',1)->orderBy('created_at','desc')->paginate(5);
            $eventCount=Event::where('published_at',1)->count();
        }
        elseif($request->get('status')&&$request->get('status')=='draft'){
            $events=Event::where('published_at',0)->orderBy('created_at','desc')->paginate(5);
            $eventCount=Event::where('published_at',0)->count();
        }
        
        else{
           $events=Event::orderBy('created_at','desc')->paginate(5);
           $onlyTrashed=False; 
           $eventCount=event::count();
        }
        $counts=[
            'all'       =>Event::count(),
            'trashed'   =>Event::onlyTrashed()->count(),
            'published' =>Event::where('published_at',1)->count(),
            'draft'     =>Event::where('published_at',0)->count()
        ];
        return view("backend.event.index",compact('events','onlyTrashed','counts','eventCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('backend.event.create',compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\EventRequest $request)
    {   /*echo '<pre>';
        print_r($request->title);
        echo'<pre>';
        die();*/

        $data           =$this->handleRequest($request);
        $slugarray      =explode(" ", $request->title);
        $slug           =implode("-", $slugarray); 
        $data['slug']   = $slug;
        if($request->submitbutton){
            $data['published_at']=1;
        }
        elseif($request->submitdraftbutton){
            $data['published_at']=0;
        }
        
        Event::create($data);
        return redirect()->route('event.index')->with('status','The event has been successfully added !');
    }
    private function handleRequest($request){
        $data=$request->all();
        if( $request->hasFile('image')){

            $image              =$request->file('image');
            $filename           =$image->getClientOriginalName();
            $uploadPath         =public_path('img');
            $destinationPath    =$uploadPath;
            $successUploaded=$image->move($destinationPath, $filename);
            if($successUploaded){
                 $extention          =$image->getClientOriginalExtension();
                 $thumbnail          =str_replace(".{$extention}","_thumb.{$extention}",$filename);
               
            }
            $data['image']=$filename;
       /* echo '<pre>';
        print_r($request->file('image')->getClientOriginalName());
        echo'<pre>';
        die();*/
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $event=Event::findOrFail($id);
       return view('backend.event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\EventRequest $request, $id)
    {
        $event=Event::findOrFail($id);
        $oldImage=$event->image;
        if($oldImage!=$event->image){
        $this->removeImage($oldImage);
        }
        $data=$this->handleRequest($request);
        $slugarray      =explode(" ", $request->title);
        $slug           =implode("-", $slugarray); 
        $data['slug']   = $slug;
        $event->update($data);
        return redirect()->route('event.index')->with('status','The event has been successfully updated !');
    }
    private function removeImage($image){
        $uploadPath         =public_path('images');
        $destinationPath    =$uploadPath;
        $imagePath     =$uploadPath .'/'.$image;
        $extention     =substr(strrchr($image,'.'),1);
        $thumbnail     =str_replace(".{$extention}","_thumb.{$extention}",$image);
        $thumbnailPath =$uploadPath .'/'.$thumbnail;
        
        if($imagePath && file_exists(public_path('images').'/'.$image)){ unlink($imagePath);
        }
        if($thumbnailPath && file_exists(public_path('images').'/'.$image))unlink($thumbnailPath);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $event=Event::findOrFail($id);
       $event->delete();
       return redirect()->route('event.index')->with('trash',['The event has been successfully deleted !',$id]);
    }
    public function restore($id){
        $event=Event::withTrashed()->findOrFail($id);
        $event->restore();
        return redirect()->back()->with('status', 'The post has been restroed!');
    }
    public function forceDestroy($id){
        $event=Event::withTrashed()->findOrFail($id);
        $event->forceDelete();
        $this->removeImage($event->image);
        return redirect()->back()->with('status', 'The post has been permanantly deleted!');
    }
}
