<?php

namespace App\Http\Controllers;

use App\Donation;
use App\User;
use App\Comment;
use App\Event;
use Illuminate\Http\Request;

class DonationController extends Controller
{

    public function __construct()
    {
         
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->forget(['user_id', 'donation_id','transaction_data','order_id']);
        $donations=Donation::with('entrepreneurs')->published()->orderBy('created_at','desc')->get();
        $events=Event::get()->sortByDesc('date')->take(3);

        return view('donate.index',compact('donations','events'));
    }
    public function entrepreneur(User $user){
        $name=$user->name;
        $donations=$user->donations()->published()->get();
        $events=Event::get()->sortByDesc('date')->take(3);
        return view('donate.index',compact('donations','name','events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_donation(Donation $donation){
        $donation=Donation::with('entrepreneurs')->where('slug',$donation->slug)->first();
        $comments=Comment::with('donation')->where('donation_id',$donation->id)->simplePaginate(5);
        

        $commentsCount=Comment::with('donation')->where('donation_id',$donation->id)->count();
        return view('donate.single_donation',compact('donation','comments','commentsCount'));
    }
    public function show_events(Event $event){
        $event=Event::where('slug',$event->slug)->first();
      
        return view('donate.single_event',compact('event'));
    }


    public function create()
    {
        //
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
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        //
    }
}
