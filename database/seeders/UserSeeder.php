<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Vianca Contreras',
            'email'     => 'via@gmail.com',
            'password'  => '123123'
        ]);

        $adminRole =  Role::where('name', 'administrador')->first();

        $admin->assignRole($adminRole);
    }
}
