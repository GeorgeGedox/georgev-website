<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\User();
        $admin->name = "Admin";
        $admin->email = "admin@georgev.design";
        $admin->password = Hash::make("admin");
        $admin->admin = true;
        $admin->email_verified_at = now();
        $admin->save();
    }
}
