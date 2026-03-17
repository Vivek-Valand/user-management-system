<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        $totalRoles = Role::count();
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)->count();
        
        $recentlyJoinedUsers = User::with('role')->latest()->take(5)->get();

        return view('dashboard', compact('totalUsers', 'activeUsers', 'totalRoles', 'newUsersThisMonth', 'recentlyJoinedUsers'));
    }
}
