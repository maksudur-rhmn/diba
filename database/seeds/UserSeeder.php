<?php

use App\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker =  Faker::create('App\User'); 

        // factory(User::class, 50)->create();

        // Enable the code below for creating 4 default accounts with different roles
      
       $user_id =  User::insertGetId([
            'name'              => 'Admin',
            'email'             => 'admin@admin.com',
            'phone'             => '01643390112',
            'password'          => Hash::make('1234567890'),
            'email_verified_at' => Carbon::now(),
            'created_at'        => Carbon::now(),
            
        ]); 
        $user = User::findOrFail($user_id);

        $user->assignRole('Admin');

        $user_id = User::insertGetId([
            'name'     => 'Editor',
            'email'    => 'editor@editor.com',
            'phone'             => '01234567891',
            'password'          => Hash::make('1234567890'),
            'email_verified_at' => Carbon::now(),
            'created_at'        => Carbon::now(),
        ]);
        
        $user = User::findOrFail($user_id);

        $user->assignRole('Editor');
        
        $user_id = User::insertGetId([
            'name'     => 'Moderator',
            'email'    => 'moderator@moderator.com',
            'phone'             => '01234567892',
            'password'          => Hash::make('1234567890'),
            'email_verified_at' => Carbon::now(),
            'created_at'        => Carbon::now(),
        ]); 

        $user = User::findOrFail($user_id);

        $user->assignRole('Moderator');

        $user_id = User::insertGetId([
            'name'     => 'User',
            'email'    => 'user@user.com',
            'phone'             => '01643390182',
            'password'          => Hash::make('1234567890'),
            'email_verified_at' => Carbon::now(),
            'created_at'        => Carbon::now(),
        ]); 

        $user = User::findOrFail($user_id);

        $user->assignRole('User');

   
        
    }
}
