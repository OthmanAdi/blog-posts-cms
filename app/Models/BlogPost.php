<?php

class Blogpost extends AbstractContent
{

    public function __construct(
        protected string $title,
        protected string $content,
        protected string $title,
        protected ?string $excerpt = null,
        protected array $catagories = [],
        protected string $status = 'draft',
    )

    {
        parent::__constuct();
    }

    public function render(): string{

        try{
            // Convert Markdown to
            return STr::markdown($this->content);
        }
        catch (Exception ex)
        {
            Log::error(("Markdown error:" {ex.getMessage()}));
            return $this->content
        }

    }

    public function getType(): string{
        return "blog_post";
    }


}
