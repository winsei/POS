<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::paginate(10); // Fetch all users
        return view('admin.HakAkses.index', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,owner,user,kasir',
        ]);

        // Create the new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'role' => $request->role,
        ]);

        // Redirect back to the user management page with a success message
        return redirect()->route('HakAkses.index')->with('success', 'User added successfully.');
    }

    public function create()
    {
        // Return the form to add a new user
        return view('admin.HakAkses.tambah');
    }

    public function edit(User $user)
    {
        // Return the form to edit the user
        return view('admin.HakAkses.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ensure the email is unique except for the current user
            'role' => 'required|in:admin,owner,user,kasir', // Validate role field
        ]);

        // Update user data (name, email, and role)
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, // Update role
        ]);

        // Redirect back to the user management page with a success message
        return redirect()->route('HakAkses.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Redirect back to the user management page with a success message
        return redirect()->route('HakAkses.index')->with('success', 'User deleted successfully.');
    }
}