<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Donation;
use App\Order;

class TransactionController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
    public function index(Request $request,Donation $donation)
    {
    	$donation_id=$donation->id;
       	$order=new Order();
       	$request->session()->put('donation_id',$donation->id);
       	$request->session()->put('user_id',auth()->user()->id);
    	return view('transaction.transactionForm',compact('order'));

    }
    public function store(Requests\TransactionRequest $request)
    {
    	$data=$request->all();
        $profit_per_donation=(2*$request->grand_total)/100;
        $grandTotal=($request->grand_total-$profit_per_donation);
        $data['grand_total']=$grandTotal;
 		$id = DB::table('orders')->insertGetId([
            'profit'=>$profit_per_donation,
    		'grand_total'=>$grandTotal,
    		'currency'=>$request->currency,
    		'entrepreneur_id'=>auth()->user()->id,
    		'donation_id'=>Session::get('donation_id'),
			]);

 		$order_id=$request->session()->put('order_id',$id);
    	$transaction_data=$request->session()->put('transaction_data',$data);
       
    	return redirect('/pay');
    }
    public function transaction_success(Request $request){
    	$transaction_memo=$request->session()->all();
    	return view('transaction.success');
    }
}
