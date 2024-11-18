<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;



class BlogPost extends AbstractContent
{
    public function __construct(
        protected string $title = "",
        protected string $content = "",
        protected ?string $excerpt = null,
        protected array $categories = [],
        protected string $status = 'draft',
    )
    {
        parent::__construct(); // wichtig fur Laravel]
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
