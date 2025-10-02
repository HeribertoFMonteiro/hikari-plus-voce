<?php
/**
 * Cache.php - Sistema simples de cache
 */

class Cache
{
    private static $instance = null;
    private $cacheDir;

    private function __construct()
    {
        $this->cacheDir = CACHE_DIR;
        $this->ensureCacheDir();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function ensureCacheDir()
    {
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    private function getCacheFile($key)
    {
        return $this->cacheDir . md5($key) . '.cache';
    }

    public function set($key, $data, $ttl = null)
    {
        if (!CACHE_ENABLED) {
            return false;
        }

        $ttl = $ttl ?: CACHE_TTL;
        $cacheFile = $this->getCacheFile($key);

        $cacheData = [
            'data' => $data,
            'expires' => time() + $ttl
        ];

        return file_put_contents($cacheFile, serialize($cacheData)) !== false;
    }

    public function get($key)
    {
        if (!CACHE_ENABLED) {
            return null;
        }

        $cacheFile = $this->getCacheFile($key);

        if (!file_exists($cacheFile)) {
            return null;
        }

        $cacheData = unserialize(file_get_contents($cacheFile));

        if ($cacheData['expires'] < time()) {
            $this->delete($key);
            return null;
        }

        return $cacheData['data'];
    }

    public function delete($key)
    {
        $cacheFile = $this->getCacheFile($key);
        if (file_exists($cacheFile)) {
            unlink($cacheFile);
        }
    }

    public function clear()
    {
        $files = glob($this->cacheDir . '*.cache');
        foreach ($files as $file) {
            unlink($file);
        }
    }

    public function has($key)
    {
        if (!CACHE_ENABLED) {
            return false;
        }

        $cacheFile = $this->getCacheFile($key);

        if (!file_exists($cacheFile)) {
            return false;
        }

        $cacheData = unserialize(file_get_contents($cacheFile));
        return $cacheData['expires'] >= time();
    }
}
?>
