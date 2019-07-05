<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:register {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user account if none exist.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Check if an admin account exists already
        if (User::where('admin', true)->first() !== null){
            $this->error("Cannot create multiple administrator accounts!");
            return false;
        }

        $email = $this->argument('email');
        $password = $this->secret("Password:");

        $admin = new \App\User();
        $admin->name = "Admin";
        $admin->email = $email;
        $admin->password = Hash::make($password);
        $admin->admin = true;
        $admin->email_verified_at = now();
        $admin->save();

        $this->info("Account successfully created!");
    }
}
