<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Crypt;

use App\User;
use App\Rider;
use App\Driver;
use App\Direction;
use App\Preferences;
use App\RideInfo;

use Illuminate\Http\Request;

class RideFinderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
    
    public function getRides(Request $request)
    {
        $data = [];
        $index = 0;
        // // AND
        // $results = SomeModel::where('location', $location)->where('blood_group', $bloodGroup)->get();

        // // OR
        // $results = SomeModel::where('location', $location)->orWhere('blood_group', $bloodGroup)->get()
       
        $id = Auth::user()->user_id;
        $rider = Rider::where('role_id', '=', $id)->first();

        $myRoute = Direction::where('direction_id', '=', $rider->direction_id)->first();
        //Route specifications
        $waypoints = $myRoute->wayPoints;

        $end = $myRoute->destination;
        $end = explode(',', $end);
        $e_lat = $end[0];
        $e_lng = $end[1];

        $start = $myRoute->origin;
        $start = explode(',', $start);
        $o_lat = $start[0];
        $o_lng = $start[1];
        
        //Find Nearest points/routes according to preferenecs/radius
        $dist=0;

        $dir = Direction::where('routeOf', '=', 'driver')->get();
        $length = count($dir);

        for($i=0; $i<$length; $i++)
        {
            $s_dist =0; $e_dist=0; $wp_dist=[]; $wp_dist_count=0;
            $find=false;
            // Find this route LatLng
            // findDistace($p1_lat, $p1_lng, $p2_lat, $p2_lng)

            //origin
            $LatLng = $dir[$i]->origin;
            $LatLng = explode(',', $LatLng);
            $d_lat = $LatLng[0];
            $d_lng = $LatLng[1];
            //end
            $LatLng = $dir[$i]->destination;
            $LatLng = explode(',', $LatLng);
            $de_lat = $LatLng[0];
            $de_lng = $LatLng[1];

            //Calculate distance around start
            $s_dist = $this->findDistance($o_lat, $o_lng, $d_lat, $d_lng);

            //Calculate distance around end
            $e_dist = $this->findDistance($e_lat, $e_lng, $de_lat, $de_lng);

            //Driver waypoints/stops
            if($dir[$i]->wayPoints!=null)
            {
                $wp = $dir[$i]->wayPoints;
                $wp = explode(',,', $wp);
                //NearestPoints around waypoints
                for($k=0;$k< count($wp)-1 ;$k++)
                {
                    $LatLng = $wp[$k];
                    $LatLng = explode(',', $LatLng);
                    $wp_lat = $LatLng[0];
                    $wp_lng = $LatLng[1];
                    
                    //Calculate distance around end
                    $wp_dist[$wp_dist_count++] = $this->findDistance($o_lat, $o_lng, $wp_lat, $wp_lng);
                }
            }//analyze all waypoints

            for($j=0; $j< $wp_dist_count; $j++)
            {
                if($wp_dist[$j]<3)
                    {$find = true;}
            }
                if( ($s_dist<10 && $e_dist<10) || $find==true)
                {
                    //Directions
                    $data[$index]['id'] = $dir[$i]->direction_id;
                    $data[$index]['origin'] = $dir[$i]->origin;
                    $data[$index]['destination'] = $dir[$i]->destination;
                    $data[$index]['startAddr'] = $dir[$i]->startAddr;
                    $data[$index]['endAddr'] = $dir[$i]->endAddr;
                    $data[$index]['distance'] = $dir[$i]->distance;
                    $data[$index]['duration'] = $dir[$i]->duration;
                    $data[$index]['wayPoints'] = $dir[$i]->wayPoints;
                    
                    $date = $dir[$i]->created_at->toFormattedDateString();  
                    $data[$index]['created_at'] = $date;

                    //Driver
                    $driver = Driver::where('driver_id', '=', $dir[$i]->user_id)->first();
                    $data[$index]['email'] = $driver->email;
                    $data[$index]['name'] = $driver->name;
                    $data[$index]['phone'] = $driver->phone;

                    //Ride Info
                    if($driver->info_id!='')
                    {
                        $info = RideInfo::where('info_id', '=', $driver->info_id)->first();
                        $data[$index]['total_seats'] = $info->total_seats;
                        $data[$index]['reserved_seats'] = $info->reserved_seats;
                        $data[$index]['v_type'] = $info->v_type;
                        $data[$index]['departure_time'] = $info->departure_time;
                        $data[$index]['arrival_time'] = $info->arrival_time;
                        $data[$index]['passengers'] = $info->passengers;

                        $date = $info->updated_at->toDateTimeString();
                        $data[$index]['updated_at'] = $date;
                    }
                    $index++;
                }//enf of if check of distance

        }//end of for loop

        return $data;

    }
    public function findDistance($p1_lat, $p1_lng, $p2_lat, $p2_lng)
    {
        //Calculate distance bwtween two
        $dist_km = 0;
        $theta = $p1_lng - $p2_lng; 
        $dist = sin(deg2rad($p1_lat)) * sin(deg2rad($p2_lat)) +  
                cos(deg2rad($p1_lat)) * cos(deg2rad($p2_lat)) * 
                cos(deg2rad($theta)); 
        $dist = acos($dist); 
        $dist = rad2deg($dist); 
        $miles = $dist * 60 * 1.1515;

        $dist_km =  ($miles * 1.609344); //In KM 
        return $dist_km;
    }
    public function getPreview()
    {
        $id = \Request::get('q');
        //This id direction id
        $data = [];
        $dir = Direction::where('direction_id', '=', $id)->first();
        $driver = Driver::where('driver_id', '=', $dir->user_id)->first();

        //Directions
        $data['id'] = $dir->direction_id;
        $data['origin'] = $dir->origin;
        $data['destination'] = $dir->destination;
        $data['startAddr'] = $dir->startAddr;
        $data['endAddr'] = $dir->endAddr;
        $data['distance'] = $dir->distance;
        $data['duration'] = $dir->duration;
        $data['wayPoints'] = $dir->wayPoints;
        
        $date = $dir->created_at->toFormattedDateString();  
        $data['created_at'] = $date;

        //Driver
        $driver = Driver::where('driver_id', '=', $dir->user_id)->first();
        if(Auth::check())
        {
            $data['myId'] = Auth::user()->user_id;
        }
        $data['friendId'] = $driver->role_id;
        $data['email'] = $driver->email;
        $data['name'] = $driver->name;
        $data['profile_pic'] = $driver->profile_pic;
        $data['phone'] = $driver->phone;

        //Ride Info
        if($driver->info_id!='')
        {
            $info = RideInfo::where('info_id', '=', $driver->info_id)->first();
            $data['total_seats'] = $info->total_seats;
            $data['reserved_seats'] = $info->reserved_seats;
            $data['v_type'] = $info->v_type;
            $data['departure_time'] = $info->departure_time;
            $data['arrival_time'] = $info->arrival_time;
            $data['passengers'] = $info->passengers;

            $date = $info->updated_at->toDateTimeString();
            $data['updated_at'] = $date;
        }

        return $data;
    }
    public function getRiderPreview()
    {
        $id = \Request::get('q');
        //This id direction id
        $data = [];
        $dir = Direction::where('direction_id', '=', $id)->first();
        $rider = Rider::where('rider_id', '=', $dir->user_id)->first();

        //Directions
        $data['id'] = $dir->direction_id;
        $data['origin'] = $dir->origin;
        $data['destination'] = $dir->destination;
        $data['startAddr'] = $dir->startAddr;
        $data['endAddr'] = $dir->endAddr;
        $data['distance'] = $dir->distance;
        $data['duration'] = $dir->duration;
        $data['wayPoints'] = $dir->wayPoints;
        
        $date = $dir->created_at->toFormattedDateString();  
        $data['created_at'] = $date;

        //Driver
        if(Auth::check())
        {
            $data['myId'] = Auth::user()->user_id;
        }
        $data['friendId'] = $rider->role_id;

        $rider = Rider::where('rider_id', '=', $dir->user_id)->first();
        $data['email'] = $rider->email;
        $data['name'] = $rider->name;
        $data['profile_pic'] = $rider->profile_pic;
        $data['phone'] = $rider->phone;

        //Ride Info
        if($rider->pref_id!='')
        {
            $info = Preferences::where('pref_id', '=', $rider->pref_id)->first();
            $data['fare'] = $info->reserved_seats;
            $data['v_type'] = $info->v_type;
            $data['departure_time'] = $info->departure_time;
            $data['arrival_time'] = $info->arrival_time;
            $data['passengers'] = $info->passengers;

            $date = $info->updated_at->toDateTimeString();
            $data['updated_at'] = $date;
        }

        return $data;
    }
    public function getPublicRides(Request $request)
    {

        $data = [];
        $index = 0;

        //Route specifications
        $waypoints = $request->wayPoints;

        $end = $request->destination;
        $end = explode(',', $end);
        $e_lat = $end[0];
        $e_lng = $end[1];

        $start = $request->origin;
        $start = explode(',', $start);
        $o_lat = $start[0];
        $o_lng = $start[1];
        
        //Find Nearest points/routes according to preferenecs/radius
        $dist=0;

        $dir = Direction::where('routeOf', '=', 'driver')->get();
        $length = count($dir);

        for($i=0; $i<$length; $i++)
        {
            $s_dist =0; $e_dist=0; $wp_dist=[]; $wp_dist_count=0;
            $find=false;
            // Find this route LatLng
            // findDistace($p1_lat, $p1_lng, $p2_lat, $p2_lng)

            //origin
            $LatLng = $dir[$i]->origin;
            $LatLng = explode(',', $LatLng);
            $d_lat = $LatLng[0];
            $d_lng = $LatLng[1];
            //end
            $LatLng = $dir[$i]->destination;
            $LatLng = explode(',', $LatLng);
            $de_lat = $LatLng[0];
            $de_lng = $LatLng[1];

            //Calculate distance around start
            $s_dist = $this->findDistance($o_lat, $o_lng, $d_lat, $d_lng);

            //Calculate distance around end
            $e_dist = $this->findDistance($e_lat, $e_lng, $de_lat, $de_lng);

            //Driver waypoints/stops
            if($dir[$i]->wayPoints!=null)
            {
                $wp = $dir[$i]->wayPoints;
                $wp = explode(',,', $wp);
                //NearestPoints around waypoints
                for($k=0;$k< count($wp)-1 ;$k++)
                {
                    $LatLng = $wp[$k];
                    $LatLng = explode(',', $LatLng);
                    $wp_lat = $LatLng[0];
                    $wp_lng = $LatLng[1];
                    
                    //Calculate distance around end
                    $wp_dist[$wp_dist_count++] = $this->findDistance($o_lat, $o_lng, $wp_lat, $wp_lng);
                }
            }//analyze all waypoints

            for($j=0; $j< $wp_dist_count; $j++)
            {
                if($wp_dist[$j]<3)
                    {$find = true;}
            }
                if( ($s_dist<10 && $e_dist<10) || $find==true)
                {
                    //Directions
                    $data[$index]['id'] = $dir[$i]->direction_id;
                    $data[$index]['origin'] = $dir[$i]->origin;
                    $data[$index]['destination'] = $dir[$i]->destination;
                    $data[$index]['startAddr'] = $dir[$i]->startAddr;
                    $data[$index]['endAddr'] = $dir[$i]->endAddr;
                    $data[$index]['distance'] = $dir[$i]->distance;
                    $data[$index]['duration'] = $dir[$i]->duration;
                    $data[$index]['wayPoints'] = $dir[$i]->wayPoints;
                    
                    $date = $dir[$i]->created_at->toFormattedDateString();  
                    $data[$index]['created_at'] = $date;

                    //Driver
                    $driver = Driver::where('driver_id', '=', $dir[$i]->user_id)->first();
                    $data[$index]['email'] = $driver->email;
                    $data[$index]['name'] = $driver->name;
                    $data[$index]['phone'] = $driver->phone;

                    //Ride Info
                    if($driver->info_id!='')
                    {
                        $info = RideInfo::where('info_id', '=', $driver->info_id)->first();
                        $data[$index]['total_seats'] = $info->total_seats;
                        $data[$index]['reserved_seats'] = $info->reserved_seats;
                        $data[$index]['v_type'] = $info->v_type;
                        $data[$index]['departure_time'] = $info->departure_time;
                        $data[$index]['arrival_time'] = $info->arrival_time;
                        $data[$index]['passengers'] = $info->passengers;

                        $date = $info->updated_at->toDateTimeString();
                        $data[$index]['updated_at'] = $date;
                    }
                    $index++;
                }//enf of if check of distance

        }//end of for loop

        return $data;
    }
    public function getRelevantRiders(Request $request)
    {
        $data = [];
        $index = 0;
        // // AND
        // $results = SomeModel::where('location', $location)->where('blood_group', $bloodGroup)->get();

        // // OR
        // $results = SomeModel::where('location', $location)->orWhere('blood_group', $bloodGroup)->get()
       
        $id = Auth::user()->user_id;
        $driver = Driver::where('role_id', '=', $id)->first();
        $myRoute = Direction::where('direction_id', '=', $driver->direction_id)->first();
        //Route specifications
        $waypoints = $myRoute->wayPoints;

        $end = $myRoute->destination;
        $end = explode(',', $end);
        $e_lat = $end[0];
        $e_lng = $end[1];

        $start = $myRoute->origin;
        $start = explode(',', $start);
        $o_lat = $start[0];
        $o_lng = $start[1];
        
        //Find Nearest points/routes according to preferenecs/radius
        $dist=0;

        $dir = Direction::where('routeOf', '=', 'rider')->get();
        $length = count($dir);

        for($i=0; $i<$length; $i++)
        {
            $s_dist =0; $e_dist=0; $wp_dist=[]; $wp_dist_count=0;
            $find=false;
            // Find this route LatLng
            // findDistace($p1_lat, $p1_lng, $p2_lat, $p2_lng)

            //origin
            $LatLng = $dir[$i]->origin;
            $LatLng = explode(',', $LatLng);
            $d_lat = $LatLng[0];
            $d_lng = $LatLng[1];
            //end
            $LatLng = $dir[$i]->destination;
            $LatLng = explode(',', $LatLng);
            $de_lat = $LatLng[0];
            $de_lng = $LatLng[1];

            //Calculate distance around start
            $s_dist = $this->findDistance($o_lat, $o_lng, $d_lat, $d_lng);

            //Calculate distance around end
            $e_dist = $this->findDistance($e_lat, $e_lng, $de_lat, $de_lng);

            //Driver waypoints/stops
            if($dir[$i]->wayPoints!=null)
            {
                $wp = $dir[$i]->wayPoints;
                $wp = explode(',,', $wp);
                //NearestPoints around waypoints
                for($k=0;$k< count($wp)-1 ;$k++)
                {
                    $LatLng = $wp[$k];
                    $LatLng = explode(',', $LatLng);
                    $wp_lat = $LatLng[0];
                    $wp_lng = $LatLng[1];
                    
                    //Calculate distance around end
                    $wp_dist[$wp_dist_count++] = $this->findDistance($o_lat, $o_lng, $wp_lat, $wp_lng);
                }
            }//analyze all waypoints

            for($j=0; $j< $wp_dist_count; $j++)
            {
                if($wp_dist[$j]<3)
                    {$find = true;}
            }
                if( ($s_dist<10 && $e_dist<10) || $find==true)
                {
                    //Directions
                    $data[$index]['id'] = $dir[$i]->direction_id;
                    $data[$index]['origin'] = $dir[$i]->origin;
                    $data[$index]['destination'] = $dir[$i]->destination;
                    $data[$index]['startAddr'] = $dir[$i]->startAddr;
                    $data[$index]['endAddr'] = $dir[$i]->endAddr;
                    $data[$index]['distance'] = $dir[$i]->distance;
                    $data[$index]['duration'] = $dir[$i]->duration;
                    $data[$index]['wayPoints'] = $dir[$i]->wayPoints;
                    
                    $date = $dir[$i]->created_at->toFormattedDateString();  
                    $data[$index]['created_at'] = $date;

                    //Rider
                    $rider = Rider::where('rider_id', '=', $dir[$i]->user_id)->first();
                    
                    $data[$index]['email'] = $rider->email;
                    $data[$index]['name'] = $rider->name;
                    $data[$index]['phone'] = $rider->phone;

                    //Ride Info
                    if($rider->pref_id!='')
                    {
                        $info = Preferences::where('pref_id', '=', $rider->pref_id)->first();
                        $data[$index]['fare'] = $info->reserved_seats;
                        $data[$index]['v_type'] = $info->v_type;
                        $data[$index]['departure_time'] = $info->departure_time;
                        $data[$index]['arrival_time'] = $info->arrival_time;
                        $data[$index]['passengers'] = $info->passengers;

                        $date = $info->updated_at->toDateTimeString();
                        $data[$index]['updated_at'] = $date;
                    }
                    $index++;
                }//enf of if check of distance

        }//end of for loop

        return $data;

    }
}
