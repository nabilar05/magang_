<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function create(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:8',
            ]);

       
            if (!isset($data['name']) || !isset($data['password'])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Missing name or password',
                ], 400);
            }

            $user = User::where('name', $data['name'])->first();

            if (!$user || !Hash::check($data['password'], $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid data',
                ], 401);
            }

         
            if (!$user->approved) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not approved yet',
                ], 403);
            }


            Auth::login($user);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'data' => $user,
                'token' => $token
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
        
            return response()->json([
                'status' => false,
                'message' => 'Login failed',
                'errors' => $e->errors() 
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}