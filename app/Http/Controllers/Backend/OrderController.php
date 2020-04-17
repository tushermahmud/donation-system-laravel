<?php

namespace App\Http\Controllers\Backend;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
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
        
       if($request->get('status')&&$request->get('status')=='completed'){
            $orders=Order::where('order_status','completed')->orderBy('created_at','desc')->simplePaginate(5);
            $onlyTrashed=True;
            $ordersCount=Order::where('order_status','completed')->count();
        }
        elseif($request->get('status')&&$request->get('status')=='processing'){
            $orders=Order::where('order_status','processing')->orderBy('created_at','desc')->simplePaginate(5);
            $ordersCount=Order::where('order_status','processing')->count();
        }
        elseif($request->get('status')&&$request->get('status')=='failed'){
            $orders=Order::where('order_status','failed')->orderBy('created_at','desc')->simplePaginate(5);
            $ordersCount=Order::where('order_status','failed')->count();
        }
        
        else{
           $orders=Order::orderBy('created_at','desc')->simplePaginate(5);
           $onlyTrashed=False; 
           $ordersCount=Order::count();
        }
        $counts=[
            'all'       =>Order::count(),
            'completed'   =>Order::where(['order_status'=>'completed'])->count(),
            'processing' =>Order::where(['order_status'=>'processing'])->count(),
            'failed'     =>Order::where(['order_status'=>'failed'])->count(),
        ];
       

        return view('backend.order.index',compact('orders','ordersCount','counts'));
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

        $order=Order::where('order_id',$id);
        
        $order->update(['order_status'=>'completed']);
        return redirect()->back()->with('status','your transaction is Completed!');
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
