<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetTenantDatabase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Example: Get tenant info based on subdomain
        $subdomain = explode('.', $request->getHost())[0];

        $tenant = Tenant::where('subdomain', $subdomain)->first();

        if ($tenant) {
            config(['database.connections.tenant.database' => $tenant->database_name]);
            config(['database.connections.tenant.username' => $tenant->database_username]);
            config(['database.connections.tenant.password' => $tenant->database_password]);
        } else {
            // Handle invalid tenant
            abort(404);
        }
    
        return $next($request);
    }
    

     
}
