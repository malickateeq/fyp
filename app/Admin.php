<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//For authentication

class Admin extends Model
{
    //use Notifiable;
    //
    protected $primaryKey = 'admin_id';

    protected $fillable = ['name', 'email', 'password', 'role', 'admin_id'];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
