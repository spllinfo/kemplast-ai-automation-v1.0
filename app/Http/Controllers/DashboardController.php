<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function index(Request $request)
    // {
    //     $user = $request->user();
    //     $viewName = "{$user->role}";
        
    //     return view($viewName, compact('user'));
    // }


    public function index()
    {
        $user = auth()->user();
        return view('dashboard', ['role' => $user->role]); // Pass role to single dashboard view
    }
}
