<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Donation;
use App\Latest;
use App\Comment;
use Illuminate\Support\Facades\Input;
class BackendDonation extends Controller
{
    public function __construct()
    {
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
            $donations=Donation::onlyTrashed()->orderBy('created_at','desc')->simplePaginate(5);
            $onlyTrashed=True;
            $donationsCount=Donation::onlyTrashed()->count();
        }
        elseif($request->get('status')&&$request->get('status')=='published'){
            $donations=Donation::published()->orderBy('created_at','desc')->simplePaginate(5);
            $donationsCount=Donation::published()->count();
        }
        elseif($request->get('status')&&$request->get('status')=='draft'){
            $donations=Donation::where('published_at',0)->orderBy('created_at','desc')->simplePaginate(5);
            $donationsCount=Donation::where('published_at',0)->count();
        }
        
        else{
           $donations=Donation::orderBy('created_at','desc')->simplePaginate(5);
           $onlyTrashed=False; 
           $donationsCount=Donation::count();
        }
        $counts=[
            'all'       =>Donation::count(),
            'trashed'   =>Donation::onlyTrashed()->count(),
            'published' =>Donation::published()->count(),
            'draft'     =>Donation::where('published_at',0)->count()
        ];

        return view('backend.donation.index',compact('donations','donationsCount','counts','onlyTrashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function forceDelete($id)
    {
        $donation=Donation::withTrashed()->findOrFail($id);
        $latest=Latest::where('donation_id',$id);
        $comment=Comment::where('donation_id',$id);
        $donation->forceDelete();
        $this->removeImage($donation->image);
        $latest->forceDelete();
        if($comment->count()!=null){
        $comment->delete();
        }
       

        return redirect()->back()->with('thrashed', 'The post has been permanantly deleted!');

    }
    private function removeImage($image){
        $uploadPath         =public_path('images');
        $destinationPath    =$uploadPath;
        $imagePath     =$uploadPath .'/'.$image;
        $extention     =substr(strrchr($image,'.'),1);
        $thumbnail     =str_replace(".{$extention}","_thumb.{$extention}",$image);
        $thumbnailPath =$uploadPath .'/'.$thumbnail;
        
        if($imagePath && file_exists(public_path('image').'/'.$image)) unlink($imagePath);
        if($thumbnailPath && file_exists(public_path('image').'/'.$image))unlink($thumbnailPath);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if(Input::get('publish')=='published'){
           
            $donationPublished=Donation::where('id',$id)->update(['published_at'=>1]);
            return redirect()->back()->with('status','your post is published!');
        }
        else{
            $donationPublished=Donation::where('id',$id)->update(['published_at'=>0]);
            return redirect()->back()->with('thrashed','your post is unpublished!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
