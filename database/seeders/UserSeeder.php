<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Avijit Acharjee',
            'email' => 'avijitach@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('654321'),
            'remember_token' => Str::random(10),
            'role_id'=>Role::where('name','Super Admin')->first()->id,
        ];
        User::create($user);
    }
}
