<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use App\Latest;

class BackendLatestController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $latestCount=0;
        $onlyTrashed=false;

        if($request->get('status')&&$request->get('status')=='trash'){

            $latest_informations=Latest::onlyTrashed()->where('donation_id',$id)->orderBy('created_at','desc')->paginate(5);

            $latestCount=Latest::onlyTrashed()->count();
            $onlyTrashed=True;
        }
        else{
        $latest_informations=Latest::withTrashed()->where('donation_id',$id)->paginate(5);
        $latestCount=Latest::withTrashed()->where('donation_id',$id)->count();
        }
        $counts=[
            'all'       =>Latest::withTrashed()->where('donation_id',$id)->count(),
            'trashed'   =>Latest::onlyTrashed()->count(),
        ];
      
        return view('profile.entrepreneur.latestNews.latestNews',compact('latest_informations','onlyTrashed','latestCount','counts','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $latest=new Latest();
        return view('profile.entrepreneur.latestNews.create',compact('latest','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\LatestRequest $request)
    {   /*echo '<pre>';
        print_r($request->title);
        echo'<pre>';
        die();*/
        
        $data           =$this->handleRequest($request);
        $slugarray      =explode(" ", $request->title);
        $slug           =implode("-", $slugarray); 
        $data['slug']   = $slug;
        $data['donation_id']=$request->donation_id;

        Latest::create($data);
        return redirect()->route('index',$request->donation_id)->with('status','The post has been successfully added !');
    }
    private function handleRequest($request){
        $data=$request->all();
        
        if( $request->hasFile('image')){

            $image              =$request->file('image');
            $filename           =$image->getClientOriginalName();
            $uploadPath         =public_path('images');
            $destinationPath    =$uploadPath;
            $successUploaded=$image->move($destinationPath, $filename);
            if($successUploaded){
                 $extention          =$image->getClientOriginalExtension();
                 $thumbnail          =str_replace(".{$extention}","_thumb.{$extention}",$filename);
                $image = Image::make($destinationPath.'/'.$filename)->resize(250, 170)->save($destinationPath.'/'.$thumbnail);
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
        $latest=Latest::findOrFail($id);
        return view('profile.entrepreneur.latestNews.edit',compact('latest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\LatestRequest $request, $id)
    {

        $donation=Latest::findOrFail($id);
        $oldImage=$donation->image;
        if($oldImage!=$donation->image);
        $this->removeImage($oldImage);
        $data=$this->handleRequest($request);
        $slugarray      =explode(" ", $request->title);
        $slug           =implode("-", $slugarray); 
        $data['slug']   = $slug;
        $donation->update($data);
        return redirect()->back()->with('status','The project has been successfully updated !');
    }
    private function removeImage($image){
        $uploadPath         =public_path('images');
        $destinationPath    =$uploadPath;
        $imagePath     =$uploadPath .'/'.$image;
        $extention     =substr(strrchr($image,'.'),1);
        $thumbnail     =str_replace(".{$extention}","_thumb.{$extention}",$image);
        $thumbnailPath =$uploadPath .'/'.$thumbnail;
        
        if($imagePath && file_exists(public_path('img').'/'.$image)) unlink($imagePath);
        if($thumbnailPath && file_exists(public_path('img').'/'.$image))unlink($thumbnailPath);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted=Latest::findOrFail($id);
        $deleted->delete();
        return redirect()->back()->with('status','The post has been successfully deleted !');
    }
    public function restore($id){
        $deleted=Latest::withTrashed()->findOrFail($id);
        $deleted->restore();
        return redirect()->back()->with('status', 'The post has been restroed!');
    }
}
