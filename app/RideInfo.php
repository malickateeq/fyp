<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RideInfo extends Model
{
    //
    protected $table = 'rideinfo';
    protected $primaryKey = 'info_id';

    //Make fields fillable
    protected $fillable = [
    'total_seats', 'reserved_seats', 'v_type', 'fare', 'passengers', 
    'arrival_time', 
    'departure_time',
    ];


}
