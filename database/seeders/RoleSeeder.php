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

// create coordintor and assign role to it
    $coordintor=\App\Models\User::create([
        'name'=>'hr_coordintor',
        'email'=>'hr_coordintor@gmail.com',
        'password'=>12345678,
        'username'=>'hr_coordintor',
    ]);
    $coordintor->assignRole('hr_coordinator');
    }
}
