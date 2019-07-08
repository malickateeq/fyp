<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preferences extends Model
{
    //
    protected $table = 'ride_preferences';
    protected $primaryKey = 'pref_id';

    
    protected $fillable = [
        'v_type', 'fare', 'passengers', 'departure_loc', 'arrival_loc', 'departure_time',
        'arrival_time',
    ];


}
