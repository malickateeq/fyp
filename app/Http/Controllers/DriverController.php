<?php

namespace App\Http\Controllers;

use App\Driver;
use App\User;
use App\Direction;
use App\RideInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Crypt;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('driver');
    } 

    public function index()
    {
        //
        return view('panels.driver');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = $request->driver_id;       //PK
        $role_id = $request->role_id;   //FK ok users table

        //Validate data
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191',
            'phone' => 'required|regex:/[0-9]{11}/',
            'password' => 'sometimes|min:3',
        ]);

        $driver = Driver::findOrFail($id);
        $user = User::findOrFail($role_id);

        //Request from profile Vue component
        $currentPic = $driver->profile_pic;
        if( $request->profile_pic != $currentPic)
        {
            //We need a unique name of pic concatenamte time+extention
            //For picking file extension loop until find first semicolon
            //then record string backwards/reverse until / encountered
            //this will pick file extension
            
            $name = time().'.' .explode('/', explode(':', substr($request->profile_pic, 0, strpos($request->profile_pic, ';')))[1])[1];
            //Image Intervention class from a package named "ImageIntervention"
            //We use \ with Image so that we don't have to import its package here
            \Image::make($request->profile_pic)->save(public_path('img/profile/').$name);
            $request->merge( ['profile_pic' => $name] ); //Override,replace

            //If file exists then delete the older file
            $prevPic = public_path('img/profile/').$currentPic;
            if(file_exists($prevPic)){
                @unlink($prevPic);
            }

        }

        //Update password appropriately
        if($request->password != ""){
            $request->password = Hash::make($request->password);
        }
        else{
            $request->password = $user->password;
        }

        //Update record in driver table
        $driver->name = $request->name;
        $driver->password = $request->password;
        $driver->phone = $request->phone;
        $driver->profile_pic = $request->profile_pic;
        $driver->save();

        //Update record in User table
        $user->name = $request->name;
        $user->password = $request->password;
        $user->save();

        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function driverProfile()
    {
        //
        $data = [];

        $id = Auth::user()->user_id;
        $user = Driver::where('role_id', '=', $id)->first();
        // $user['password'] = decrypt($user->password);

        $data['driver_id'] = $user->driver_id;
        $data['role_id'] = $user->role_id ;
        $data['name'] = $user->name ;
        $data['email'] = $user->email ;
        $data['phone'] = $user->phone ;
        //$data['password'] = $user->password ;
        $data['profile_pic'] = $user->profile_pic ;

        $data['role'] = 'Driver';

        //Rider Directions
        if($user->direction_id!="")
        {    
            $direction = Direction::findOrFail($user->direction_id);

            $data['duration'] = $direction->duration;
            $data['distance'] = $direction->distance;
            $data['startAddr'] = $direction->startAddr;
            $data['endAddr'] = $direction->endAddr;
            $data['origin'] = $direction->origin;
            $data['destination'] = $direction->destination;
            $data['wayPoints'] = $direction->wayPoints;
        }
        //Ride Info
        if($user->info_id!='')
        {
            $info = RideInfo::where('info_id', '=', $user->info_id)->first();
            $data['total_seats'] = $info->total_seats;
            $data['reserved_seats'] = $info->reserved_seats;
            $data['v_type'] = $info->v_type;
            $data['departure_time'] = $info->departure_time;
            $data['arrival_time'] = $info->arrival_time;
            $data['passengers'] = $info->passengers;
        }

        return $data;
    }
    public function setDriverDirections(Request $request)
    {
        //Validate data
        
        $this->validate($request,[
            'distance' => 'required',
            'duration' => 'required',
            'origin' => 'required|min:2',
            'destination' => 'required|min:2',
        ]);

        $driver = Driver::findOrFail($request->driver_id);

        if($driver->direction_id==""){
            $direction = new Direction;
        }
        else{
            $direction = Direction::findOrFail($driver->direction_id);
        }

        $direction->user_id = $request->driver_id;
        $direction->routeOf = 'driver';
        $direction->distance = $request->distance;
        $direction->duration = $request->duration;
        $direction->origin = $request->origin;
        $direction->destination = $request->destination;
        $direction->startAddr = $request->startAddr;
        $direction->endAddr = $request->endAddr;
        $direction->wayPoints = $request->wayPoints;

        $direction->save();

        $driver->direction_id = $direction->direction_id;

        $driver->save();

        return "Success!";
    }
    
    public function setRideInfo(Request $request)
    {
        //Validate data
        $this->validate($request,[
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'total_seats' => 'required|max:2',
            'reserved_seats' => 'required|max:2',
            'v_type' => 'required',
            'passengers' => 'required',
        ]);
        
        $driver = Driver::where('driver_id', '=', $request->driver_id)->first();

        if($driver->info_id!='')
        {
            $info = RideInfo::where('info_id', '=', $driver->info_id);
        }
        else{
            $info = new RideInfo;
        }
        
        $info->departure_time = $request->departure_time;
        $info->arrival_time = $request->arrival_time;
        $info->total_seats = $request->total_seats;
        $info->reserved_seats = $request->reserved_seats;
        $info->v_type = $request->v_type;
        $info->passengers = $request->passengers;
        $info->save();

        $driver->info_id = $info->info_id;
        $driver->save();
        
        return "success";

    }
}
