<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Anda bisa mengambil data pengguna dari Auth
        $user = auth()->user();
        
        return view('user.profile', compact('user'));
    }
}
