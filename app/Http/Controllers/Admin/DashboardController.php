<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
       
        $num_users      = User::count();
        $num_posts      = Post::count();
        $num_categories = Category::count();
        $num_tags       = Tag::count();

        return view('admin.dashboard',compact('num_categories','num_posts','num_users','num_tags'));

    }
}
