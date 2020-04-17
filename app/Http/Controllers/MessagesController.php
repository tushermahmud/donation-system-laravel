<?php

namespace App\Http\Controllers;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use App\Events\MessageSent;

class MessagesController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
    public function index(){
        return view('layouts/messages');
    }
    public function fetchMessages(){
    	$users=Message::with('user')->all();
    }
    public function sendMessages(Request $request){
    	auth()->user()->messages()->create(['message'=>$request->message]);
    	broadcast(new MessageSent(auth()->user(),$request->message))->toOthers();
    	return response(['status'=>'successful']);
    }
}
