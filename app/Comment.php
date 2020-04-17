<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';
    protected $fillable = [
        'body','donation_id','entrepreneur_id'
    ];
    public function donation(){
    	return $this->belongsTo(Donation::class,'donation_id');
    }
    public function entrepreneurs(){
    	return $this->belongsTo(User::class,'entrepreneur_id');
    }
}
