<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use App\Rider;
use App\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/rider';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //We only access it when we are guest (simple visitors) 
        //If we are logged in we can't access it
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'role' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = new User;
        //Add in Users table
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        //Store users data in relevant tables
        if($data['role'] == 'rider')
        {
            $rider = new Rider;

            $user->role = $data['role'];
            $user->save();

            $rider->role_id = $user->user_id;
            $rider->name = $data['name'];
            $rider->email = $data['email'];
            $rider->password = Hash::make($data['password']);

            $rider->save();

            // Rider::create([
            //     'name' => $data['name'],
            //     'email' => $data['email'],
            //     'password' => Hash::make($data['password']),
            // ]);
        }
        else if($data['role'] == 'driver')
        {
            $driver = new Driver;

            $user->role = $data['role'];
            $user->save();

            $driver->role_id = $user->user_id;
            $driver->name = $data['name'];
            $driver->email = $data['email'];
            $driver->password = Hash::make($data['password']);

            $driver->save();
        }
        else if($data['role'] == 'admin')
        {
            $admin = new Admin;

            $user->role = $data['role'];
            $user->save();
            
            $admin->role_id = $user->user_id;
            $admin->name = $data['name'];
            $admin->email = $data['email'];
            $admin->password = Hash::make($data['password']);

            $admin->save();
        }

        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'role' => $data['role'],
        //     'password' => Hash::make($data['password']),
        // ]);
        return $user;
    }
}
