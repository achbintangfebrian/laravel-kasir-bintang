<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the token from the Authorization header
        $token = $request->header('Authorization');
        
        // If no token, return unauthorized
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: No token provided',
            ], 401);
        }
        
        // Find admin with this token
        $admin = Admin::where('api_token', $token)->first();
        
        // If no admin found, return unauthorized
        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }
        
        // Attach admin to request for use in controllers
        $request->admin = $admin;
        
        return $next($request);
    }
}