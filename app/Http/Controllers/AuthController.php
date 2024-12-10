<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
        {
            // Validate the input data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8|confirmed',
            ]);
        
            // Check if email already exists in the users table
            $existingUser = User::where('email', $validatedData['email'])->first();
            
            if ($existingUser) {
                return response()->json(['message' => 'The email address is already registered.'], 409);
            }
        
            // If email is not taken, proceed to create the user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
        
            // Create a token for the newly created user
            $token = $user->createToken('auth_token')->plainTextToken;
        
            // Return the token in the response
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
    

    public function login(Request $request)
        {
            // Validate input data
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            
            // Check if the credentials are correct
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid login details. Please check your email and password.',
                ], 401);  // Unauthorized status code
            }
        
            // If credentials are valid, get the user and generate a token
            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
        
            // Return success response with the token
            return response()->json([
                'message' => 'Login successfully',
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);  // OK status code
        }
        

    public function logout(Request $request)
        {
            $request->user()->tokens()->delete();
        
            return response()->json([
                'message' => 'Logged out successfully',
            ]);
        }
}
