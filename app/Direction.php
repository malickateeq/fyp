<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    //
    protected $table = 'directions';
    protected $primaryKey = 'direction_id';

    //Make fields fillable
    protected $fillable = ['startAddr','endAddr','distance', 'duration', 'wayPoints',
'origin', 'destination', 'user_id', 'stops'
];
    
}
