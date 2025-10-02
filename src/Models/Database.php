<?php
/**
 * Database.php - Conexão e operações com banco de dados
 */

require_once __DIR__ . '/../Config/config.php';
require_once __DIR__ . '/../Cache.php';
require_once __DIR__ . '/../Logger.php';

class Database
{
    private static $instance = null;
    private $pdo;
    private $cache;
    private $logger;

    private function __construct()
    {
        $this->cache = Cache::getInstance();
        $this->logger = Logger::getInstance();
        $this->connect();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET
            ];

            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

            $this->logger->info("Database connection established successfully", [
                'host' => DB_HOST,
                'database' => DB_NAME
            ]);

        } catch (PDOException $e) {
            $this->logger->critical("Database connection failed", [
                'error' => $e->getMessage(),
                'host' => DB_HOST,
                'database' => DB_NAME
            ]);
            throw new Exception("Erro na conexão com o banco de dados");
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    // Método seguro para executar queries com cache
    public function query($sql, $params = [], $cacheKey = null, $cacheTtl = null)
    {
        try {
            // Verificar cache se chave fornecida
            if ($cacheKey && $this->cache->has($cacheKey)) {
                $this->logger->debug("Cache hit for query", ['key' => $cacheKey]);
                return $this->cache->get($cacheKey);
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchAll();

            // Salvar no cache se chave fornecida
            if ($cacheKey) {
                $this->cache->set($cacheKey, $result, $cacheTtl);
                $this->logger->debug("Query result cached", ['key' => $cacheKey]);
            }

            return $result;

        } catch (PDOException $e) {
            $this->logger->error("Database query failed", [
                'sql' => $sql,
                'params' => $params,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    // Método para executar queries que não retornam dados
    public function execute($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute($params);

            $this->logger->debug("Query executed successfully", [
                'sql' => $sql,
                'affected_rows' => $stmt->rowCount()
            ]);

            return $result;

        } catch (PDOException $e) {
            $this->logger->error("Database execute failed", [
                'sql' => $sql,
                'params' => $params,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    // Método específico para buscar traduções com cache
    public function getTranslations($language = 'pt')
    {
        $cacheKey = "translations_{$language}";

        try {
            $sql = "SELECT chave, {$language} AS texto FROM translations";
            $translations = $this->query($sql, [], $cacheKey, CACHE_TTL * 24); // Cache por 24 horas

            return array_column($translations, 'texto', 'chave');

        } catch (Exception $e) {
            $this->logger->error("Failed to load translations", [
                'language' => $language,
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }

    // Método para limpar cache
    public function clearCache()
    {
        $this->cache->clear();
        $this->logger->info("Database cache cleared");
    }

    // Método para verificar saúde da conexão
    public function ping()
    {
        try {
            $this->pdo->query('SELECT 1');
            return true;
        } catch (Exception $e) {
            $this->logger->error("Database ping failed", ['error' => $e->getMessage()]);
            return false;
        }
    }
}

// Instância global para compatibilidade
try {
    $pdo = Database::getInstance()->getConnection();
} catch (Exception $e) {
    if (APP_DEBUG) {
        die("Erro na conexão: " . $e->getMessage());
    } else {
        error_log("Database connection error: " . $e->getMessage());
        die("Erro interno do servidor");
    }
}
?>
