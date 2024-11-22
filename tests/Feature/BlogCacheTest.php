<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\BlogPost;
use App\Services\ContentCache;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogCacheTest extends TestCase{
    use RefreshDatabase;

    public function test_posts_are_cached()
    {
        $post = BlogPost::create([
            'title' => 'Test Post',
            'content' => 'Test Content',
            'status' => 'published'
        ]);
        $response = $this->get('/blog');
        $response ->assertStatus(200);
        $cache = ContentCache::getInstance();

        $cachedValue = $cache->getRedis()->get('blog:published_posts');

        $this->assertNotNull($cachedValue);

        $cachedPosts = unserialize($cachedValue);
        $this->assertEquals($post->title,$cachedPosts->first()->title);
    }
    Public function test_cache_is_cleared_on_post_update()
    {
        $post = BlogPost::create([
            'title' => 'Test Post',
            'content' => 'Test Content',
            'status' => 'published'
        ]);
        $this->get('/blog');
        $post->update(['title' => 'Updated Title']);
        $cache = ContentCache::getInstance();
        $cachedValue = $cache->getRedis()->get('blog:published_posts');
        $this->assertNull($cachedValue);

    }
}
