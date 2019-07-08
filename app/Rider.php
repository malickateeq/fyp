<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    //
    protected $primaryKey = 'rider_id';

    
    protected $fillable = [
        'name', 'email', 'password', 'rider_id', 'pref_id', 'direction_id'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];


    
}
