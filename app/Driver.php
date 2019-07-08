<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    
    protected $table = 'drivers';
    protected $primaryKey = 'driver_id';

    //Make fields fillable
    protected $fillable = ['name', 'email', 'password', 'phone', 'driver_id'];


    //Creating Driver relationship to the Vehicle and V_Route
    public function vehicle()
    {
        return $this->hasOne('App\Vehicle', 'driver_id');    
        //look for namespace, foreign_key(driver key)
    }
    //
    public function direction()
    {
        return $this->hasOne('App\Direction', 'driver_id');
    }

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
