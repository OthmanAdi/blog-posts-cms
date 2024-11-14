<?php

use Illuminate\Database\Eloquent\Model;

abstract class AbstractContent extends Model implements ContentInterface{

     // welche Felder durfen NICHT massenhaft befuhlt werden
    protected $guarded = [];

    // Methoden MUSS jeder Kind-klasse implementieren
    abstract public function render(): string;
    abstract public function getType() : string;


    public function getTitle(): string{
        return $this->title;
    }


    public function getContent(): string{
        return $this->content;
    }

    public function getSlug(): string{
        return $this->slug;
    }

    public function getAuthor(): ?User{
        return $this->author;
    }


    public function isPublished(): bool{
        return $this->status==='published';
    }

}
