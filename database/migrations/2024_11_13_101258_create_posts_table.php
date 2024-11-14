<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {  
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->text('excerpt')->nullable();
            $table->json('categories')->nullable();
            $table->string('status')->default('draft');
            // REMOVED THE FUCKING FOREIGN KEY
            // NO MORE author_id
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
};