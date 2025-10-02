<?php
/**
 * Security.php - Utilitários de segurança e validação
 */

require_once __DIR__ . '/Config/config.php';

class Security
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

    // Gera token CSRF
    public function generateCSRFToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    // Verifica token CSRF
    public function verifyCSRFToken($token)
    {
        if (!isset($_SESSION['csrf_token']) || empty($token)) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }

    // Sanitiza entrada de string
    public function sanitizeString($input)
    {
        // Remove espaços em branco do início e fim
        $input = trim($input);

        // Remove tags HTML/PHP
        $input = strip_tags($input);

        // Escapa caracteres especiais HTML
        $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return $input;
    }

    // Sanitiza email
    public function sanitizeEmail($email)
    {
        return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    }

    // Valida email
    public function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Sanitiza e valida entrada geral
    public function sanitizeInput($input, $type = 'string')
    {
        switch ($type) {
            case 'email':
                return $this->sanitizeEmail($input);
            case 'int':
                return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
            case 'float':
                return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            case 'url':
                return filter_var($input, FILTER_SANITIZE_URL);
            default:
                return $this->sanitizeString($input);
        }
    }

    // Rate limiting básico
    public function checkRateLimit($identifier, $maxRequests = RATE_LIMIT_REQUESTS, $window = RATE_LIMIT_WINDOW)
    {
        $cache = Cache::getInstance();
        $key = "rate_limit_{$identifier}";
        $currentTime = time();

        $requests = $cache->get($key) ?: [];

        // Remove requests fora da janela
        $requests = array_filter($requests, function($timestamp) use ($currentTime, $window) {
            return ($currentTime - $timestamp) < $window;
        });

        // Verifica limite
        if (count($requests) >= $maxRequests) {
            return false;
        }

        // Adiciona nova request
        $requests[] = $currentTime;
        $cache->set($key, $requests, $window);

        return true;
    }

    // Gera hash seguro para senhas
    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_ARGON2ID, [
            'memory_cost' => 65536,
            'time_cost' => 4,
            'threads' => 3
        ]);
    }

    // Verifica senha
    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    // Gera string aleatória segura
    public function generateRandomString($length = 32)
    {
        return bin2hex(random_bytes($length / 2));
    }

    // Escapa HTML para prevenir XSS
    public function escapeHtml($input)
    {
        return htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    // Valida tamanho do arquivo de upload
    public function validateFileSize($file, $maxSize = MAX_FILE_SIZE)
    {
        return $file['size'] <= $maxSize;
    }

    // Valida tipo de arquivo
    public function validateFileType($file, $allowedTypes = ALLOWED_EXTENSIONS)
    {
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        return in_array($extension, $allowedTypes);
    }

    // Move arquivo de upload com nome seguro
    public function moveUploadedFile($file, $destination)
    {
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = $this->generateRandomString(16) . '.' . $extension;
        $fullPath = $destination . '/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $fullPath)) {
            return $filename;
        }

        return false;
    }
}

// Funções helper globais
function csrf_token()
{
    return Security::getInstance()->generateCSRFToken();
}

function sanitize($input, $type = 'string')
{
    return Security::getInstance()->sanitizeInput($input, $type);
}

function escape($input)
{
    return Security::getInstance()->escapeHtml($input);
}

function rate_limit_check($identifier)
{
    return Security::getInstance()->checkRateLimit($identifier);
}
?>
