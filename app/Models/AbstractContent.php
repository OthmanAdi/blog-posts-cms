<?php

namespace App\Models;

use App\Interfaces\ContentInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

abstract class AbstractContent extends Model implements ContentInterface
{
    protected $guarded = [];

    abstract public function render(): string;
    abstract public function getType(): string;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }
}