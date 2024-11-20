<?php

namespace App\Models;


// import basic stuff
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
class BlogPost extends AbstractContent
{



    public function __construct(
        protected string $title = "",
        protected string $content = "",
        protected ?string $excerpt = null,
        protected array $catagories = [],
        protected string $status = 'draft',
    )



    {
        parent::__construct();
    }

    public function render(): string
    {
        try{
//            Markdown zu HTML Umwandeln
            return Str::markdown($this->content);
        }
        catch (Exception $ex){
//            Fallback, wenn was schiefgeht
            Log::error("Markdown Fehler: {$ex->getMessage()}");
            return $this->content;
        }
    }

    public function getType(): string{
        return "blog_post";
    }


}
