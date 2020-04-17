<?php

namespace App\Http\Controllers\Auth;
use Socialite;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use App\Mail\verifyEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/donation';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ]);
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
     public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser);
        return redirect($this->redirectTo);
    }
    public function findOrCreateUser($user)
    {
        
        $authUser = User::where('email', $user->email)->first();
        if ($authUser) {
            return $authUser;
        }

        $slugarray      =explode(" ",$user->name);
        $slug           =implode("-", $slugarray);

        $user= User::create([
            'name'      => $user->name,
            'email'     => $user->email,
            'role'      => 'user',
            'slug'      => $slug,
            'avater'    =>  $user->avatar_original,
            'verify_token'=>null,
            'status'=>1
        ]);
        return $user;
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $slugarray      =explode(" ", $data['name']);
        $slug           =implode("-", $slugarray); 
        $data['slug']   = $slug;
        $data['password']=bcrypt($data['password']);
        $data['verify_token']=str_random(40);
      

        $user= User::create($data);
        $thisUser=User::findOrFail($user->id);
        $this->sendEmail($thisUser);
        return $user;
    }
    public function sendEmail($user){
        Mail::to($user['email'])->send(new verifyEmail($user));
    }
    public function verifyEmail(){
        return view('email.verifyemail');
    }
    public function verify($email,$token){
        $user=User::where('email',$email)->where('verify_token',$token)->first();
        if($user->status==0){
            if($user){
                User::where('email',$email)->where('verify_token',$token)->update(['status'=>1,'verify_token'=>null]);
                return redirect()->route('login')->with('status','Your e-mail is verified. You can now login.');
            }
            else{
                return redirect()->route('login')->with('status','Your e-mail is verified. You can now login.');
            }
        }
        else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }
        
    } 
}
