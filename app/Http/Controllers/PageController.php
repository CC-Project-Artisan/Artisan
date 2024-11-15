<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor;

class PageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function shop()
    {
        return view('pages.shop');
    }

    public function about()
    {
        return view('pages.about');
    }

    //Dashboard
    public function dashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->role;

            switch ($role) {
                case 'vendor':
                    $vendor = Vendor::where('user_id', $user->id)->first();
                    if ($vendor) {
                        return view('vendor.dashboard', compact('vendor'));
                    } else {
                        return view('welcome');
                    }
                case 'user':
                    return view('user.dashboard');
                case 'admin':
                    return view('admin.dashboard')->with('user', $user);
                default:
                    return view('welcome');
            }
        }

        return redirect()->route('login');
    }

    //Admin Test
    public function admintest()
    {
        return view('admin.test');
    }
}
