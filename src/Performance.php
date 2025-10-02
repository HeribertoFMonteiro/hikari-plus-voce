<?php
/**
 * Performance.php - Otimizações de performance
 */

class Performance
{
    private static $instance = null;

    private function __construct() {}

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Inicia output buffering com compressão
    public function startOutputBuffering()
    {
        if (ENABLE_GZIP && !APP_DEBUG) {
            if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
                ini_set('zlib.output_compression', 'On');
                ini_set('zlib.output_compression_level', 6);
            }
        }

        // Iniciar buffer
        ob_start();
    }

    // Finaliza output buffering
    public function endOutputBuffering()
    {
        if (ob_get_level() > 0) {
            ob_end_flush();
        }
    }

    // Minifica HTML (básico)
    public function minifyHtml($html)
    {
        if (!ENABLE_MINIFICATION || APP_DEBUG) {
            return $html;
        }

        // Remove comentários HTML
        $html = preg_replace('/<!--[^\[<>].*?(?<!!)-->/s', '', $html);

        // Remove espaços em branco desnecessários
        $html = preg_replace('/\s+/', ' ', $html);
        $html = preg_replace('/>\s+</', '><', $html);

        return trim($html);
    }

    // Otimiza imagens (placeholder para futuro)
    public function optimizeImage($imagePath)
    {
        // Implementar otimização de imagem com bibliotecas como Imagick ou GD
        // Por enquanto, apenas verifica se o arquivo existe
        return file_exists($imagePath);
    }

    // Cache de páginas (básico)
    public function cachePage($content, $key, $ttl = 3600)
    {
        $cache = Cache::getInstance();
        return $cache->set("page_{$key}", $content, $ttl);
    }

    public function getCachedPage($key)
    {
        $cache = Cache::getInstance();
        return $cache->get("page_{$key}");
    }

    // Lazy loading helper
    public function addLazyLoading($html)
    {
        // Adiciona loading="lazy" às imagens
        return preg_replace(
            '/<img([^>]+)src=/i',
            '<img$1loading="lazy" src=',
            $html
        );
    }

    // Headers de cache para assets
    public function setAssetCacheHeaders($filePath)
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        $cacheTimes = [
            'css' => 2592000,  // 30 dias
            'js' => 2592000,   // 30 dias
            'png' => 2592000,  // 30 dias
            'jpg' => 2592000,  // 30 dias
            'jpeg' => 2592000, // 30 dias
            'gif' => 2592000,  // 30 dias
            'svg' => 2592000,  // 30 dias
            'woff' => 2592000, // 30 dias
            'woff2' => 2592000 // 30 dias
        ];

        if (isset($cacheTimes[$extension])) {
            $maxAge = $cacheTimes[$extension];
            header("Cache-Control: public, max-age={$maxAge}");
            header("Expires: " . gmdate("D, d M Y H:i:s", time() + $maxAge) . " GMT");
        }
    }
}

// Funções helper
function start_performance()
{
    Performance::getInstance()->startOutputBuffering();
}

function end_performance()
{
    $performance = Performance::getInstance();
    $content = ob_get_clean();
    $content = $performance->minifyHtml($content);
    $content = $performance->addLazyLoading($content);
    echo $content;
}
?>
