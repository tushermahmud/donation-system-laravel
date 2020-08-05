<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Donation extends Model
{
    use softDeletes;
    protected $table='donations';
    protected $fillable = [
        'title', 'slug','published_at','image','donation_needed','body','description','additional','goals','entrepreneur_id','total_collection'
    ];
	public function entrepreneurs(){
    	return $this->belongsTo(User::class,'entrepreneur_id');
	}
	public function latests(){
    	return $this->hasMany(Latest::class,'donation_id');
    }
    public function orders(){
    	return $this->hasMany(Order::class,'donation_id');
    }
    public function comments(){
        return $this->hasMany(Comments::class,'donation_id');
    }
	public function getRouteKeyName() {
        return 'slug';
    }
    public function scopePublished($query){
       return $query->where('published_at',1);
        
    }
    public function scopeNotPublished($query){
       return $query->where('published_at',0);
        
    }
}
