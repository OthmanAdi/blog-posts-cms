<?php

use App\Models\User;

interface ContentInterface {
// Title des BlogPosts zurukgeben
public function getTitle(): string;

// Inhalt des Posts
public function getContent(): string;

// URL-freundlicher Name
public function getSlug(): string;

// Wer hat den Post geschrieben?
public function getAuthor(): ?User; //Null Safe Code

// Ist der Post verofentlicht
public function isPublished(): bool;
}
