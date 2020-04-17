<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
class Latest extends Model
{
    protected $table='latests';
    use softDeletes;
    protected $fillable = [
        'title', 'body', 'image','donation_id','slug'
    ];
    public function getRouteKeyName() {
        return 'slug';
    }
    public function Donation(){
    	return $this->belongsTo(Donation::class,'donation_id');
    }
}
