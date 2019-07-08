<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Crypt;


use App\Rider;
use App\User;
use App\Direction;
use App\Preferences;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rider');
    } 

    public function index()
    {
        //

        return view('panels.rider');
        //return "Hello from driver controller";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Returning Driver Registration page
        return view('auth.register_driver');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Store Driver data in database
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

    public function profile()
    {
        //
        $data = [];

        $id = Auth::user()->user_id;
        $user = Rider::where('role_id', '=', $id)->first();
        // $user['password'] = decrypt($user->password);

        $data['rider_id'] = $user->rider_id;
        $data['role_id'] = $user->role_id ;
        $data['name'] = $user->name ;
        $data['email'] = $user->email ;
        $data['phone'] = $user->phone ;
        //$data['password'] = $user->password ;
        $data['profile_pic'] = $user->profile_pic ;

        $data['role'] = 'Rider';

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
        //Rider Preferences
        if($user->pref_id!="")
        {    
            $pref = Preferences::findOrFail($user->pref_id);

            $data['departure_time'] = $pref->departure_time ;
            $data['arrival_time'] = $pref->arrival_time ;
            $data['v_type'] = $pref->v_type ;
            $data['fare'] = $pref->fare ;
        }

        return $data;
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
        $id = $request->rider_id;       //PK
        $role_id = $request->role_id;   //FK ok users table

        //Validate data
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191',
            'phone' => 'required|regex:/[0-9]{11}/',
            'password' => 'sometimes|min:3',
        ]);

        $rider = Rider::findOrFail($id);
        $user = User::findOrFail($role_id);

        //Request from profile Vue component
        $currentPic = $rider->profile_pic;
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

        //Update record in Rider table
        $rider->name = $request->name;
        $rider->password = $request->password;
        $rider->phone = $request->phone;
        $rider->profile_pic = $request->profile_pic;
        $rider->save();

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

    public function setDirections(Request $request)
    {
        //Validate data
        $this->validate($request,[
            'distance' => 'required',
            'duration' => 'required',
            'origin' => 'required|min:2',
            'destination' => 'required|min:2',
        ]);

        $rider = Rider::findOrFail($request->rider_id);

        if($rider->direction_id==""){
            $direction = new Direction;
        }
        else{
            $direction = Direction::findOrFail($rider->direction_id);
        }

        $direction->user_id = $request->rider_id;
        $direction->routeOf = 'rider';
        $direction->distance = $request->distance;
        $direction->duration = $request->duration;
        $direction->origin = $request->origin;
        $direction->destination = $request->destination;
        $direction->startAddr = $request->startAddr;
        $direction->endAddr = $request->endAddr;
        $direction->wayPoints = $request->wayPoints;
        $direction->stops = $request->stops;
        $direction->save();

        $rider->direction_id = $direction->direction_id;

        $rider->save();

        return "Success!";
    }
    public function setPreferences(Request $request)
    {
        //Validate data
        $this->validate($request,[
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'v_type' => 'required',
        ]);

        $rider = Rider::findOrFail($request->rider_id);
        
        if($rider->pref_id=="")
        {
            $pref = new Preferences;
        }
        else{
            $pref = Preferences::findOrFail($rider->pref_id);
        }

            $pref->departure_time = $request->departure_time ;
            $pref->arrival_time = $request->arrival_time ;
            $pref->v_type = $request->v_type ;

            $pref->save();

            $rider->pref_id = $pref->pref_id;
            $rider->save();

        return "success";

    }
}
