<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Event extends Model
{
    use softDeletes;
    protected $table='events';
    protected $fillable = [
        'title', 'place','organizer', 'description','slug','created_at','updated_at','image','published_at','date'
    ];
    public function getRouteKeyName() {
        return 'slug';
    }
}
