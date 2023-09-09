<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        //create two role one for hr manager and one for hr coordinator
       Role::create([
            'name'=>'hr_manager',
        ]);
        Role::create([
            'name'=>'hr_coordinator',

        ]);

    // create user and assign role to it
    $user=\App\Models\User::create([
        'name'=>'hr_manager',
        'email'=>'hr_manager@gmail.com',
        'password'=>12345678,
        'username'=>'hr_manager',
    ]);
    $user->assignRole('hr_manager');

// create coordinator and assign role to it
    $coordinator=\App\Models\User::create([
        'name'=>'hr_coordinator',
        'email'=>'hr_coordinator@gmail.com',
        'password'=>12345678,
        'username'=>'hr_coordinator',
    ]);
    coordinator->assignRole('hr_coordinator');
    }
}
