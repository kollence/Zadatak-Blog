<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {   
        if (Auth::user()->hasRole('blogwriter')) {
            return view('blogwriter/writersdash');
        }elseif (Auth::user()->hasRole('admin')) {
            $users = User::all();
            
            
            return view('admin/adminsdash', compact('users'));
        }
    }

    public function admin()
    {
            $users = User::all();
            return view('admin/controlpanel', compact('users'));
    }
    public function writer()
    {            // Just writers blogs
            $writer = User::find(Auth::user()->id)->blogs;
        return view('blogwriter/profile', ['blogs' => $writer]);
    }
    public function createpost()
    {
        return view('blogwriter/create');
    }
}
