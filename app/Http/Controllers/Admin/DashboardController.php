<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){

        $num_posts = Post::count();
        $num_users = User::count();

        return view('admin.dashboard',compact('num_posts','num_users'));

    }
}
