<?php

namespace App\Interfaces;

use App\Models\User;

interface ContentInterface
{
//  Title des Blogposts zuruckgeben
    public function getTitle(): string;

//  Inhalt des Posts zuruckgeben
    public function getContent(): string;

//  URL-freundlicher Name
    public function getSlug(): string;

//  Wer hat den Post geschrieben?
    public function getAuthor(): ?User; //Null Safe Code

//  Ist der Post veroffentlicht?
    public function isPublished(): bool;
}