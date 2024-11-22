<?php

namespace App\Http\Controllers;


use App\Models\BlogPost;
use App\Services\ContentCache;


class BlogController extends Controller
{

    private $cache; // Gebraucht fur den Cache Instanz

    public function __construct(){
        $this->cache = ContentCache::getInstance();

    }
    public function index(){

        $cacheKey = 'published_posts';
        $posts = $this->cache->remember($cacheKey, function(){
            return BlogPost::where('status', 'published')->get();
        }, 3600);

        return view('blog.index', compact('posts'));
    }




//     $posts = BlogPost::where('status', 'published')->get();
//     return view('blog.index', compact('posts'));
// }


}
