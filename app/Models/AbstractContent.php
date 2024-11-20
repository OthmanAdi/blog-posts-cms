<?php

namespace App\Models;

use App\Interfaces\ContentInterface;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

abstract class AbstractContent extends Model implements ContentInterface
{
//    welche Felder drufen nicht massenhaft befüllt werden
    protected $guarded = [];

//    Methoden MUSS jede Kind-Klasse implementieren
    abstract public function render(): string;
    abstract public function getType(): string;

    public function getTitle(): string{
        return $this->title;
    }

    public function getContent(): string{
        return  $this->content;
    }

    public function getSlug(): string{
        return $this->slug;
    }

    public function getAuthor(): ?User{
        return $this->auth;
    }

    public function isPublished(): bool{
        return  $this->status === 'published';
    }
}
