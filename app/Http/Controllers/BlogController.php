<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BlogPost;

class BlogController extends Controller
{
   public function index()
   {
    $posts = BlogPost::where('status', 'published')->get();
    return view ('blog.index', compact('posts'));
   }
}
