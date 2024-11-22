<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ContentCache
{
    // Singleton-Instance
    private static ?self $instance = null;
    private $redis;

    private function __construct()
    {
        // Redis verbindung herstellen
        $this->redis = Redis::connection();
    }

    // Singleton-Instanz Abrufen
    public static function getInstance(): self
    {
        // Prüft ob Singleton-Instanz existiert
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Haupt-Cache Funktion
    public function remember(string $key, callable $callback, int $ttl = 3600)
    {
        try {
            // Versuche Daten aus Cache zu holen
            $value = $this->redis->get("blog:$key");

            // Wenn Daten im Cache sind
            if (!is_null($value)) {
                return unserialize($value); // Gib sie aus
            }

            $fresh = $callback(); // Wenn nicht im Cache - Hole die Daten neu

            $this->redis->setex("blog:$key", $ttl, serialize($fresh));
            // Speichert im Cache
            return $fresh;
        } catch (Exception $e) {
            Log::error("Cache Fehler: {$e->getMessage()}");
            return $callback();
        }
    }

    // Hinzufügen des getRedis() Methode
    public function getRedis()
    {
        return $this->redis;
    }
}
