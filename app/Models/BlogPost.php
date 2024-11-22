<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Services\ContentCache;
use Exception;
use Illuminate\Mail\Mailables\Content;
use ZipStream\Exception\SimulationFileUnknownException;



class BlogPost extends AbstractContent
{
    // public function __construct(
    //     protected string $title = "",
    //     protected string $content = "",
    //     protected ?string $excerpt = null,
    //     protected array $categories = [],
    //     protected string $status = 'draft',
    // )
    // {
    //  parent::__construct(); // wichtig fur Laravel]
    //}

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'categories',
        'status'
    ];

    protected $casts = [
        'categories' => 'array'
    ];

    protected static function booted(){                 //Event Listner
        static::saved(function($post) {
            self::clearCache($post);
            });

            static::deleted(function ($post) {
                self::clearCache($post);
            });
    }
    public static function clearCache(){
        $redis = ContentCache::getInstance()->getRedis();
        $redis->del("blog:published_posts");
    }

    public function render(): string
    // {
    //     try {
    //         return Str::markdown($this->content);
    //         }
    //     catch (Exception $e) {
    //         Log::error("Markdown Fehler: {$e->getMessage()}");
    //         return $this->content;
    //         }

    // }
    {
        try {
        $cacheKey ="post_redered_{$this->id}";

            return ContentCache::getInstance()->remember($cacheKey, function(){
                return Str::markdown($this->content);
            }, 3600);
        } catch (Exception $e) {
            Log::error("Markdown Fehler: {$e->getMessage()}");
            return $this->content;
        }


    }

    public function getType(): string
    {
        return 'blog_post';
    }

}
