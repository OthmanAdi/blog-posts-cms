<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        // Remove cache for now - let's get it working first
        $posts = BlogPost::where('status', 'published')->get();
        return view('blog.index', compact('posts'));
    }
}