<?php
/**
 * Logger.php - Sistema de logs estruturado
 */

class Logger
{
    private static $instance = null;
    private $logDir;
    private $logLevel;

    const LEVELS = [
        'DEBUG' => 0,
        'INFO' => 1,
        'WARNING' => 2,
        'ERROR' => 3,
        'CRITICAL' => 4
    ];

    private function __construct()
    {
        $this->logDir = LOG_DIR;
        $this->logLevel = self::LEVELS[LOG_LEVEL] ?? self::LEVELS['WARNING'];
        $this->ensureLogDir();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function ensureLogDir()
    {
        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0755, true);
        }
    }

    private function shouldLog($level)
    {
        return self::LEVELS[$level] >= $this->logLevel;
    }

    private function writeLog($level, $message, $context = [])
    {
        if (!$this->shouldLog($level)) {
            return;
        }

        $timestamp = date('Y-m-d H:i:s');
        $logFile = $this->logDir . date('Y-m-d') . '.log';

        $contextStr = !empty($context) ? ' | Context: ' . json_encode($context) : '';
        $logMessage = sprintf("[%s] %s: %s%s\n", $timestamp, $level, $message, $contextStr);

        file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
    }

    public function debug($message, $context = [])
    {
        $this->writeLog('DEBUG', $message, $context);
    }

    public function info($message, $context = [])
    {
        $this->writeLog('INFO', $message, $context);
    }

    public function warning($message, $context = [])
    {
        $this->writeLog('WARNING', $message, $context);
    }

    public function error($message, $context = [])
    {
        $this->writeLog('ERROR', $message, $context);
    }

    public function critical($message, $context = [])
    {
        $this->writeLog('CRITICAL', $message, $context);
    }

    // Método helper para log de exceções
    public function logException(Exception $e, $context = [])
    {
        $context = array_merge($context, [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);

        $this->error($e->getMessage(), $context);
    }

    // Log de acesso (para auditoria)
    public function logAccess($action, $userId = null, $ip = null, $userAgent = null)
    {
        $context = [
            'action' => $action,
            'user_id' => $userId,
            'ip' => $ip ?: $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $userAgent ?: $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'url' => $_SERVER['REQUEST_URI'] ?? 'unknown',
            'method' => $_SERVER['REQUEST_METHOD'] ?? 'unknown'
        ];

        $this->info("Access: {$action}", $context);
    }
}
?>
