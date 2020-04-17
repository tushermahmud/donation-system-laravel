<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;

class CommentController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	public function create(Requests\CommentRequest $request,$id ){
		$data=$request->all();
		$data['entrepreneur_id']=auth()->user()->id;
		$data['donation_id']=$id;
		Comment::create($data);
		return redirect()->back();
	}
    
}
