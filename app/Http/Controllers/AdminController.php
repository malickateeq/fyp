<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Crypt;

use App\User;
use App\Admin;
use App\Rider;
use App\Driver;
use App\Direction;
use App\RideInfo;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    } 

    public function index()
    {
        //
        return view('panels.admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        return ['message' => 'I have your data.'];
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
        $id = $request->admin_id;       //PK
        $role_id = $request->role_id;   //FK ok users table

        //Validate data
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191',
            'phone' => 'regex:/[0-9]{11}/',
            'password' => 'sometimes|min:3',
        ]); 
        $admin = Admin::findOrFail($id);
        $user = User::findOrFail($role_id);

        //Request from profile Vue component
        $currentPic = $admin->profile_pic;
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
        $admin->name = $request->name;
        $admin->password = $request->password;
        $admin->phone = $request->phone;
        $admin->profile_pic = $request->profile_pic;
        $admin->save();

        //Update record in User table
        $user->name = $request->name;
        $user->password = $request->password;
        $user->save();

        return "success";
    }

    public function findUser()
    {
        $users = new User;
        //Search function in admin panel
        if($search = \Request::get('q')){
            $users = User::where( function($query) use ($search){
                $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email','LIKE',"%$search%")
                ->orWhere('role','LIKE',"%$search%");
            })->paginate(5);
        }
        else{
            $users = User::latest()->paginate(5);
        }

        return $users;
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

    public function addNewMember(Request $request)
    {
        //Validate data
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:3',
            'role' => 'required'
        ]);

        //Add new member from admin panel
        $data = $request;

        //Add in Users table
        $user = new User;

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

    }

    public function getUsers()
    {
        //
        return User::latest()->paginate(5);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        //Request to delete user from admin panel

        if($user->role == 'admin')
        {
            Admin::where('role_id', '=', $id)->delete();
        }
        else if($user->role == 'rider')
        {
            Rider::where('role_id', '=', $id)->delete();
        }
        else if($user->role == 'driver')
        {
            Driver::where('role_id', '=', $id)->delete();
        }
        
        //Delete from Users table
        User::destroy($id);


        return ['message'=> 'User deleted!'];
    }
    public function updateUser(Request $request)
    {
        $id = $request->user_id;
        $user = User::find($id);

        //Validate data
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191',
            'password' => 'sometimes|min:3',
            'role' => 'required'
        ]);
        //
        //$user = User::where('user_id', $id)->get();
        //Update password appropriately
        if($request->password != ""){
            $request->password = Hash::make($request->password);
        }
        else{
            $request->password = $user->password;
        }

        $user->password = $request->password;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        //Updateon ralevent tables
        if($user->role == 'admin')
        {
            $admin = Admin::where('role_id', '=', $id)->first();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = $request->password;
            $admin->save();
            //specified operation
        }
        else if($user->role == 'rider')
        {
            $rider = Rider::where('role_id', '=', $id)->first();
            $rider->name = $request->name;
            $rider->email = $request->email;
            $rider->password = $request->password;
            $rider->save();
        }
        else if($user->role == 'driver')
        {
            $driver = Driver::where('role_id', '=', $id)->first();
            $driver->name = $request->name;
            $driver->email = $request->email;
            $driver->password = $request->password;
            $driver->save();
        }
    }

    public function adminProfile()
    {
        //
        $data = [];

        $id = Auth::user()->user_id;
        $user = Admin::where('role_id', '=', $id)->first();
        // $user['password'] = decrypt($user->password);

        $data['admin_id'] = $user->admin_id;
        $data['role_id'] = $user->role_id ;
        $data['name'] = $user->name ;
        $data['email'] = $user->email ;
        $data['phone'] = $user->phone ;
        //$data['password'] = $user->password ;
        $data['profile_pic'] = $user->profile_pic ;

        $data['role'] = 'Admin';

        return $data;
    }

    public function getStats(){
        $data = [];
        //$data['temp'] = 'Im Don';

        $data['total_users'] = User::count();
        $data['total_drivers'] = Driver::count();
        $data['total_routes'] = Direction::count();

        return $data;
    }
    
}
