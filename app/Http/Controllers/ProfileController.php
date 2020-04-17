<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
class ProfileController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
    public function index(User $user){
    	$user=$user->where('slug',$user->slug)->get();
    	return view('profile.profile',compact('user'));

    }
    public function update(Requests\UserRequest $request,User $user){
    	$data['name']=$request->name;
    	$data['email']=$request->email;
    	$data['password']=bcrypt($request->password);
    	$user_information=User::where('slug',$user->slug);
    	$user_information->update($data);
    	return redirect('profile/'.$user->slug)->with('status','You have Successfully updated your profile');
    }
}
