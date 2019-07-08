<?php

use Illuminate\Support\Facades\Hash;
use App\User;
use App\Admin;
use App\Rider;
use App\Driver;
use Illuminate\Database\Seeder;

class InitialUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //Admin Seeds - - - - - - - - - - - - - - - - - //

        //Initial Admin
        $user = new User;
        $user->name = "malik ateeq";
        $user->email = "malik@gmail.com";
        $user->password = Hash::make('123');
        $user->role = "admin";
        $user->save();
        
        $admin = new Admin;
        $admin->role_id = $user->user_id;
        $admin->name = "malik ateeq";
        $admin->email = "malik@gmail.com";
        $admin->password = Hash::make('123');
        $admin->save();


        //New Record Start
        $user = new User;
        $user->name = "Saad Ullah";
        $user->email = "saad@gmail.com";
        $user->password = Hash::make('123');
        $user->role = "admin";
        $user->save();
        
        $admin = new Admin;
        $admin->role_id = $user->user_id;
        $admin->name = "Saad Ullah";
        $admin->email = "saad@gmail.com";
        $admin->password = Hash::make('123');
        $admin->save();
        //New Record End

        //New Record Start
        $user = new User;
        $user->name = "Khalid Raza";
        $user->email = "khalid@gmail.com";
        $user->password = Hash::make('123');
        $user->role = "admin";
        $user->save();
        
        $admin = new Admin;
        $admin->role_id = $user->user_id;
        $admin->name = "Khalid Raza";
        $admin->email = "khalid@gmail.com";
        $admin->password = Hash::make('123');
        $admin->save();
        //New Record End


        //Driver Seeds - - - - - - - - - - - - - - - - - //

        //New Record Start
        $user = new User;
        $user->name = "Khan Saab";
        $user->email = "driver@gmail.com";
        $user->password = Hash::make('123');
        $user->role = "driver";
        $user->save();
        
        $driver = new Driver;
        $driver->role_id = $user->user_id;
        $driver->name = "Khan Sab";
        $driver->email = "driver@gmail.com";
        $driver->password = Hash::make('123');
        $driver->save();
        //New Record End

        //New Record Start
        $user = new User;
        $user->name = "Khan Saab";
        $user->email = "b@gmail.com";
        $user->password = Hash::make('123');
        $user->role = "driver";
        $user->save();
        
        $driver = new Driver;
        $driver->role_id = $user->user_id;
        $driver->name = "Khan Sab";
        $driver->email = "b@gmail.com";
        $driver->password = Hash::make('123');
        $driver->save();
        //New Record End

        //New Record Start
        $user = new User;
        $user->name = "Khan Saab";
        $user->email = "c@gmail.com";
        $user->password = Hash::make('123');
        $user->role = "driver";
        $user->save();
        
        $driver = new Driver;
        $driver->role_id = $user->user_id;
        $driver->name = "Khan Sab";
        $driver->email = "c@gmail.com";
        $driver->password = Hash::make('123');
        $driver->save();
        //New Record End

        //New Record Start
        $user = new User;
        $user->name = "Khan Saab";
        $user->email = "d@gmail.com";
        $user->password = Hash::make('123');
        $user->role = "driver";
        $user->save();
        
        $driver = new Driver;
        $driver->role_id = $user->user_id;
        $driver->name = "Khan Sab";
        $driver->email = "d@gmail.com";
        $driver->password = Hash::make('123');
        $driver->save();
        //New Record End


        //Rider Seeds - - - - - - - - - - - - - - - - - //

        //New Record Start
        $user = new User;
        $user->name = "Khan Saab";
        $user->email = "rider@gmail.com";
        $user->password = Hash::make('123');
        $user->role = "rider";
        $user->save();
        
        $rider = new Rider;
        $rider->role_id = $user->user_id;
        $rider->name = "Khan Sab";
        $rider->email = "rider@gmail.com";
        $rider->password = Hash::make('123');
        $rider->save();
        //New Record End

        //New Record Start
        $user = new User;
        $user->name = "Khan Saab";
        $user->email = "f@gmail.com";
        $user->password = Hash::make('123');
        $user->role = "rider";
        $user->save();
        
        $rider = new Rider;
        $rider->role_id = $user->user_id;
        $rider->name = "Khan Sab";
        $rider->email = "f@gmail.com";
        $rider->password = Hash::make('123');
        $rider->save();
        //New Record End

        //New Record Start
        $user = new User;
        $user->name = "Khan Saab";
        $user->email = "g@gmail.com";
        $user->password = Hash::make('123');
        $user->role = "rider";
        $user->save();
        
        $rider = new Rider;
        $rider->role_id = $user->user_id;
        $rider->name = "Khan Sab";
        $rider->email = "g@gmail.com";
        $rider->password = Hash::make('123');
        $rider->save();
        //New Record End

        //New Record Start
        $user = new User;
        $user->name = "Khan Saab";
        $user->email = "h@gmail.com";
        $user->password = Hash::make('123');
        $user->role = "rider";
        $user->save();
        
        $rider = new Rider;
        $rider->role_id = $user->user_id;
        $rider->name = "Khan Sab";
        $rider->email = "h@gmail.com";
        $rider->password = Hash::make('123');
        $rider->save();
        //New Record End

    }
}
