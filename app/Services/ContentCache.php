<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

// Hauptzweck con caching system ist: Performsnce Optimisation fur blog-post
// Radis Speichert Daten im RAM.
// Haupdatenbank (MySQL) -- Cachdatenbank (Redis)
class ContentCache {

    //singeltion-instanz
    private static ?self $instance = null;
    private $redis;

    private function __construct() {
        //Redis verbindung herstellen
        $this->redis = Redis::connection();
     }

        //Singeltone-Instanz Abrufen
     public function gitInstance(): self {
        //pruft ob singelton-instany existiert
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
     }

     // haupt cache Funktion
     public function remember(string $key, callable $callback, int $ttl = 3600) {
        try {
            // Versuche daten aus Cach zu holen
            $value = $this->redis->get("blog:$key");

            // Wenn Daten im Cache sind
            if (!is_null($value)) {
                return unserialize($value); // gib sie aus
            }

            $fresh = $callback(); // wenn nicht im cache - Hole die Daten neue

            $this->redis->setex("blog:$key", $ttl, serialize($fresh) );
            //speichert im Cach
            return $fresh;
        }catch (Exception $e) {
            Log::error("Cache Fehler: {$e->getMessage()}");
            return $callback();

        }
     }
}
