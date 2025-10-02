<?php
/**
 * config.php - Arquivo de configuração principal
 * Este arquivo contém todas as configurações do sistema
 */

// Ambiente da aplicação
define('APP_ENV', getenv('APP_ENV') ?: 'production');
define('APP_DEBUG', getenv('APP_DEBUG') ?: false);
define('APP_NAME', 'Hikari + Você');
define('APP_URL', getenv('APP_URL') ?: 'https://hikari-voce.com');

// Configurações de banco de dados
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'hikari_plus_voce');
define('DB_USER', getenv('DB_USER') ?: 'heriberto');
define('DB_PASS', getenv('DB_PASS') ?: '0631');
define('DB_CHARSET', 'utf8mb4');

// Configurações de email (para formulários de contato)
define('MAIL_HOST', getenv('MAIL_HOST') ?: 'smtp.gmail.com');
define('MAIL_PORT', getenv('MAIL_PORT') ?: 587);
define('MAIL_USERNAME', getenv('MAIL_USERNAME') ?: '');
define('MAIL_PASSWORD', getenv('MAIL_PASSWORD') ?: '');
define('MAIL_ENCRYPTION', getenv('MAIL_ENCRYPTION') ?: 'tls');
define('MAIL_FROM_ADDRESS', getenv('MAIL_FROM_ADDRESS') ?: 'contato@hikari-voce.com');
define('MAIL_FROM_NAME', APP_NAME);

// Configurações de segurança
define('CSRF_TOKEN_SECRET', getenv('CSRF_TOKEN_SECRET') ?: 'change-this-in-production-' . bin2hex(random_bytes(16)));
define('SESSION_LIFETIME', 7200); // 2 horas
define('RATE_LIMIT_REQUESTS', 10); // requests por minuto
define('RATE_LIMIT_WINDOW', 60); // segundos

// Configurações de cache
define('CACHE_ENABLED', true);
define('CACHE_DIR', __DIR__ . '/../cache/');
define('CACHE_TTL', 3600); // 1 hora

// Configurações de logs
define('LOG_DIR', __DIR__ . '/../logs/');
define('LOG_LEVEL', APP_DEBUG ? 'DEBUG' : 'WARNING');

// Configurações de upload (para futuro)
define('UPLOAD_DIR', __DIR__ . '/../public/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'pdf']);

// Configurações de tradução
define('DEFAULT_LANGUAGE', 'pt');
define('SUPPORTED_LANGUAGES', ['pt', 'es']);

// Configurações de performance
define('ENABLE_GZIP', true);
define('ENABLE_MINIFICATION', !APP_DEBUG);

// Criar diretórios necessários se não existirem
$dirs_to_create = [CACHE_DIR, LOG_DIR, UPLOAD_DIR];
foreach ($dirs_to_create as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Configurações de erro baseado no ambiente
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', LOG_DIR . 'php_errors.log');
}

// Timezone
date_default_timezone_set('Asia/Tokyo');
?>
