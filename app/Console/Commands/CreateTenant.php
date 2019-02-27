<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;

class CreateTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'command:name';
    protected $signature = 'tenant:create {hostname} {uuid} {admin_email}';

    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Command description';
    protected $description = 'Creates a tenant with the provided hostname, uuid and admin email address e.g. php artisan tenant:create laravel.com laravel admin@example.com';

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
        $host = $this->argument('hostname');
        $uuid = $this->argument('uuid');
        $adminEmail = $this->argument('admin_email');
        //$this->tenantExists();
        
        //Create website with given uuid and system database
        $website = new Website;
        $website->uuid = $uuid;
        $website->managed_by_database_connection = 'system';
        app(WebsiteRepository::class)->create($website);
    
        //Create and connect hostname
        $hostname = new Hostname;
        $hostname->fqdn = $host;
        $hostname = app(HostnameRepository::class)->create($hostname);
        app(HostnameRepository::class)->attach($hostname, $website);
    
        // Create admin account with random password
        /*
        $password = str_random();
        User::create([
                'name' => 'admin',
                'email' => $adminEmail,
                'password' => Hash::make($password)
            ]);
        $this->info("Website '{$uuid}' is created and is now accessible at {$hostname->fqdn}");
        $this->info("Admin {$adminEmail} can log in using password {$password}");*/
    }
    
    /*private function tenantExists($name, $email)
    {
        return Customer::where('name', $name)->orWhere('email', $email)->exists();
    }
    
    private function registerTenant($name, $email)
    {
        // create a customer
        $customer = new Customer;
        $customer->name = $name;
        $customer->email = $email;
        app(CustomerRepository::class)->create($customer);
        // associate the customer with a website
        $website = new Website;
        $website->customer()->associate($customer);
        app(WebsiteRepository::class)->create($website);
        // associate the website with a hostname
        $hostname = new Hostname;
        $baseUrl = config('app.url_base');
        $hostname->fqdn = "{$name}.{$baseUrl}";
        $hostname->customer()->associate($customer);
        app(HostnameRepository::class)->attach($hostname, $website);
        return $hostname;
    }
    
    private function addAdmin($name, $email, $password)
    {
        $admin = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        return $admin;
    }*/
}
