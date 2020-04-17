<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;
use App\Donation;
class EntrepreneurController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $donationCount=0;
        $onlyTrashed=false;
        if($request->get('status')&&$request->get('status')=='trash'){
            $donation_informations=Donation::onlyTrashed()->where('entrepreneur_id',auth()->user()->id)->orderBy('created_at','desc')->paginate(5);
            $donationCount=Donation::onlyTrashed()->count();
            $onlyTrashed=True;
        }
        elseif($request->get('status')&&$request->get('status')=='published'){
            $donation_informations=Donation::where('entrepreneur_id',auth()->user()->id)->published()->orderBy('created_at','desc')->paginate(5);
            $donationCount=Donation::where('entrepreneur_id',auth()->user()->id)->where('published_at',1)->count();
        }
        elseif($request->get('status')&&$request->get('status')=='draft'){
            $donation_informations=Donation::where('entrepreneur_id',auth()->user()->id)->where('published_at',0)->orderBy('created_at','desc')->paginate(5);
            $donationCount=Donation::where('entrepreneur_id',auth()->user()->id)->where('published_at',0)->count();
        }
        else{
        $donation_informations=Donation::withTrashed()->where('entrepreneur_id',auth()->user()->id)->paginate(5);
        $donationCount=Donation::withTrashed()->where('entrepreneur_id',auth()->user()->id)->count();
        }
        $counts=[
            'all'       =>Donation::where('entrepreneur_id',auth()->user()->id)->count(),
            'trashed'   =>Donation::onlyTrashed()->count(),
            'published' =>Donation::where('entrepreneur_id',auth()->user()->id)->published()->count(),
            'draft'     =>Donation::where('entrepreneur_id',auth()->user()->id)->notpublished()->count()
        ];
        return view('profile.entrepreneur.index',compact('donation_informations','donationCount','counts','onlyTrashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $donation =new donation();
        return view('profile.entrepreneur.create',compact('donation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\DonationRequest $request)
    {   /*echo '<pre>';
        print_r($request->title);
        echo'<pre>';
        die();*/
        
        $data           =$this->handleRequest($request);
        $slugarray      =explode(" ", $request->title);
        $slug           =implode("-", $slugarray); 
        $data['slug']   = $slug;
        
        $data['published_at']=0;
        $data['entrepreneur_id']=auth()->user()->id;
        
        Donation::create($data);
        $user=User::where('id',auth()->user()->id)->update(['role'=>'entrepreneur']);
        return redirect()->route('entrepreneurs.index')->with('status','The post has been successfully added !');
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
        $donation=Donation::findOrFail($id);
        return view('profile.entrepreneur.edit',compact('donation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\DonationRequest $request, $id)
    {
        $donation=Donation::findOrFail($id);
        $oldImage=$donation->image;
        if($oldImage!=$donation->image);
        $this->removeImage($oldImage);
        $data=$this->handleRequest($request);
        $slugarray      =explode(" ", $request->title);
        $slug           =implode("-", $slugarray); 
        $data['slug']   = $slug;
        $donation->update($data);
        return redirect()->route('entrepreneurs.index')->with('status','The project has been successfully updated !');
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
        $donation=Donation::findOrFail($id);
        $donation->delete();
        return redirect()->route('entrepreneurs.index')->with('status','The post has been successfully deleted !');
    }
    public function restore($id){
        $donation=Donation::withTrashed()->findOrFail($id);
        $donation->restore();
        return redirect()->back()->with('status', 'The post has been restroed!');
    }
}
