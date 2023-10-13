<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Console\Command;

class MigrateTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:tenant';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    // public function handle()
    // {
    //     $username = $this->ask('Enter the username of the tenant to migrate:');
    //     $tenant = Tenant::where('username', $username)->first();
    //     if (!$tenant) {
    //         $this->error("Tenant {$username} not found.");
    //         return;
    //     }
    //     config(['database.connections.tenant.database' => $tenant->database_name]);
    //     // config(['database.connections.tenant.username' => $tenant->database_username]);
    //     // config(['database.connections.tenant.password' => $tenant->database_password]);
    //     $this->call('migrate', ['--database' => 'tenant','--path'=>'database/tenant_migrations']);
    //     // $this->call('migrate', [' -database' => 'tenant']);
    //     $this->info("Migrations run for tenant {$username}.");

    // }

    public function handle()
    {
        $username = $this->ask('Enter the username of the tenant to migrate:');
        
        // find the username from the users table 
        $user = User::where('username', $username)->first();

        // find the user_id from the tenants from which username was selected 
        $tenant = Tenant::where('user_id', $user->id)->first();
        if (!$tenant) {
            $this->error("Tenant {$username} not found.");
            return;
        }
        
        config(['database.connections.tenant.database' => $tenant->database_name]);
        // config(['database.connections.tenant.username' => $tenant->database_username]);
        // config(['database.connections.tenant.password' => $tenant->database_password]);
        $this->call('migrate', ['--database' => 'tenant', '--path' => 'database/tenant_migrations']);
        $this->info("Migrations run for tenant {$username}.");
    }

}
