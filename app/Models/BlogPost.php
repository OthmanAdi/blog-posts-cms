<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class BlogPost extends AbstractContent
{
    protected $table = 'blog_posts';
    
    // Add all fillable fields
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'categories',
        'status',
        'author_id'
    ];

    // Cast categories to array
    protected $casts = [
        'categories' => 'array'
    ];

    // Add automatic slug generation
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($post) {
            if (!$post->slug) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function render(): string
    {
        try {
            return Str::markdown($this->content);
        }
        catch (Exception $e) {
            Log::error("Markdown Fehler: {$e->getMessage()}");
            return $this->content;
        }
    }

    public function getType(): string
    {
        return 'blog_post';
    }
}