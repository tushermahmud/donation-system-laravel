<?php

namespace App\Http\Controllers;
use App\Latest;
use App\Donation;
use Illuminate\Http\Request;

class latestNewsController extends Controller
{
    //
    public function index($id){
    	$LatestCount=Latest::where('donation_id',$id)->count();
        $latests=Latest::where('donation_id',$id)->paginate(3);
        return view('donate.latest',compact('latests','LatestCount'));
       
    }
}
