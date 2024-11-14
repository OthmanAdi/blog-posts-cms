<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ContentCache
{
    private static ?self $instance = null;
    private $redis;

    private function __construct()
    {
        $this->redis = Redis::connection();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function remember(string $key, callable $callback, int $ttl = 3600)
    {
        try {
            $value = $this->redis->get("blog:$key");
            if (!is_null($value)) {
                return unserialize($value);
            }

            $fresh = $callback();
            $this->redis->setex("blog:$key", $ttl, serialize($fresh));
            return $fresh;
        } catch (Exception $e) {
            Log::error("Cache Fehler: {$e->getMessage()}");
            return $callback();
        }
    }
}