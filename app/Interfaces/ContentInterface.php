<?php

namespace App\Interfaces;

use App\Models\User;

interface ContentInterface
{

    // Return the Title of the blogpost

public function getTitle(): string;

// Return content of the post
public function getContent(): string;



// Return content of the post
public function getSlug(): string;

// Wer hat den Post geschrieben
public function getAuthor(): ? User;

public function isPublished() : bool;

}
