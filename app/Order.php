<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table="orders";
	protected $fillable = [
        'grand_total', 'currency', 'entrepreneur_id','donation_id','order_status','profit'
    ];
    

    public function entrepreneurs(){
    	return $this->belongsTo(User::class,'entrepreneur_id');
    }
    public function donations(){
    	return $this->belongsTo(Donation::class,'donation_id');
    }
}
