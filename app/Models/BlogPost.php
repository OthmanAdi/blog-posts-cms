<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class BlogPost extends AbstractContent
{
    //    Constructore Properties - In modern PHP syntax!
    public function __construct(
        protected string  $title = "",
        protected string  $content = "",       
        protected ?string $excerpt = null,
        protected array $catagories = [],
        protected string $status = 'draft',
    ) {
        parent::__construct(); //Wichtig fur Laravel
    }

    public function render(): string
    {
        try {
            //            Markdown zu HTML Umwandeln
            return Str::markdown($this->content);
        } catch (Exception $e) {
            //            Fallback, wenn was schiefgeht
            Log::error("Markdown Fehler: {$e->getMessage()}");
            return $this->content;
        }
    }

    public function getType(): string
    {
        return 'blog_post';
    }
}