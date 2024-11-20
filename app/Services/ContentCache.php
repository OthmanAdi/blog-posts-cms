<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

// Hauptzweck von caching systems ist: Performance Optimization fur blog-posts
// Warum Redis und nicht ein eingabautes PHP Funktion? Weil Redis Speichert Daten im RAM
// Ohne Cache: ~100-500ms datenbankabfrage X mit Redis: ~1-5ms Zugriffszeit
// mit der Verwednung von Redis haben wir 2 Datenspeciehr ort:
// 1. Hauptdatenbank (zb. MySQL, sqlite, postgres)
// 2. Redit (Cache-Datenbank)
// Code beispiel zum thema 2DB
// $post->save(); // in Hauptdatenbank Bleibt fur immer!
// $cache->remember('key', $value, 3600); // in Redis Cache speichern fur 1 Stunde
class ContentCache
{
    //singelton-instanz
    private static ?self $instance = null;
    private $redis;

    private function __construct()
    {
        // Redis-verbindung herstellen
        $this->redis = Redis::connection();
    }

    // Singelton-Instanz Abrufen
    public static function getInstance(): self
    {
        // prüfe ob singelton-instanz existiert
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // haupt cache function
    public function remember(string $key, callable $callback, int $ttl = 3600)
    {
        try {
            //A. Versuche daten aus Cache zu holen
            $value = $this->redis->get("blog:$key");

            //B. Wenn Daten im Cache 
            if (!is_null($value)) {
                return unserialize($value); //- gib sie aus
            }

            $fresh = $callback(); //C. wenn nicht im cache - Hole die daten neue

            $this->redis->setex("blog:$key", $ttl, serialize($fresh)); //D. speichere im cache

            return $fresh;
            
        } catch (Exception $e) {
            Log::error("Cache Fehler: {$e->getMessage()}");
            return $callback(); // wenn irgendwelche fehler - hole daten neue
        }
    }
}