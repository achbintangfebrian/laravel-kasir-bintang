<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        $admin = Admin::create([
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(60),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Admin registered successfully',
            'data' => [
                'id' => $admin->id,
                'role' => $admin->role,
                'email' => $admin->email,
                'api_token' => $admin->api_token,
            ]
        ], 201);
    }

    public function login(AuthRequest $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Generate or regenerate API token
        $admin->update(['api_token' => Str::random(60)]);

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'id' => $admin->id,
                'role' => $admin->role,
                'email' => $admin->email,
                'api_token' => $admin->api_token,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $admin = Admin::where('api_token', $request->header('Authorization'))->first();

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Remove the API token
        $admin->update(['api_token' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Logout successful',
        ]);
    }
}