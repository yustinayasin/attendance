<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        $users = User::all();
        return response()->json([
            'message' => 'Successfully retrieved all users',
            'data' => $users,
        ], 200);
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('users.create');
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'status' => 'required|in:active,inactive',
        ]);

        // Hash the password before saving
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return response()->json([
            'message' => 'User created successfully',
            'data' => [
                "name" => $validated['name'],
                "email" => $validated['email'],
            ], // Optionally return the user data
        ], 201);
    }

    // Display a specific user
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Show the form for editing a specific user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update a user's details in the database
    public function update(Request $request, $id)
    {
        // Retrieve the authenticated user (this will be automatically validated by Sanctum)
        // $authenticatedUser = $request->user();
        // printf('Authorization Token: ' . $request->header('Authorization'));

        // // Check if the authenticated user matches the requested user ID
        // if ($authenticatedUser->id !== (int) $id) {
        //     printf("aa");
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }

        // printf($id);

        // Find the user by ID
        $user = User::find($id);

        // If user not found
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'status' => 'required|in:active,inactive',
        ]);

        // Hash the password if it is being updated
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Update the user's information
        $user->update($validated);

        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user,  // Optionally return the updated user data
        ], 200);
    }


    // Delete a user from the database
    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Return a response, or redirect if using a web route
        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    public function showLoginForm(User $user)
    {
        return "This is login form";
    }

    // Handle user login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        printf("text");

        if (Auth::attempt($credentials)) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Check if the user's account is active
            if ($user->status !== 'active') {
                Auth::logout();
                return back()->withErrors(['status' => 'Your account is inactive.']);
            }

            // Generate API token
            $token = $user->createToken('attendance')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'data' => ['token' => $token],
            ], 200);
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    // Handle user logout
    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens->each(function ($token) {
            $token->delete(); // Revoke all tokens for the user
        });

        return response()->json(['message' => 'Successfully logged out']);
    }
}
