<?php
/**
 * AdminSettingsController.php
 * Controlador para configurações do sistema
 */

class AdminSettingsController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $this->checkAuth();

        try {
            // Buscar configurações atuais
            $settings = $this->getCurrentSettings();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->saveSettings();
            }

            include __DIR__ . '/../Views/admin/settings/index.php';
        } catch (Exception $e) {
            $error = 'Erro ao carregar configurações: ' . $e->getMessage();
            include __DIR__ . '/../Views/admin/settings/index.php';
        }
    }

    private function getCurrentSettings()
    {
        $settings = [];

        // Configurações do .env
        $env_file = __DIR__ . '/../../.env';
        if (file_exists($env_file)) {
            $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos($line, '=') !== false && !strpos(trim($line), '#')) {
                    list($key, $value) = explode('=', $line, 2);
                    $settings[trim($key)] = trim($value);
                }
            }
        }

        return $settings;
    }

    private function saveSettings()
    {
        try {
            $env_file = __DIR__ . '/../../.env';

            // Configurações básicas
            $settings = [
                'APP_ENV' => $_POST['app_env'] ?? 'production',
                'APP_DEBUG' => isset($_POST['app_debug']) ? 'true' : 'false',
                'APP_URL' => $_POST['app_url'] ?? '',
                'DB_HOST' => $_POST['db_host'] ?? 'localhost',
                'DB_NAME' => $_POST['db_name'] ?? 'hikari_plus_voce',
                'DB_USER' => $_POST['db_user'] ?? 'hikari_user',
                'DB_PASS' => $_POST['db_pass'] ?? '',
                'MAIL_HOST' => $_POST['mail_host'] ?? 'smtp.gmail.com',
                'MAIL_PORT' => $_POST['mail_port'] ?? '587',
                'MAIL_USERNAME' => $_POST['mail_username'] ?? '',
                'MAIL_PASSWORD' => $_POST['mail_password'] ?? '',
                'MAIL_ENCRYPTION' => $_POST['mail_encryption'] ?? 'tls',
                'MAIL_FROM_ADDRESS' => $_POST['mail_from_address'] ?? 'contato@hikari-voce.com',
            ];

            // Criar conteúdo do .env
            $content = "# Arquivo de configuração de ambiente - CONFIGURAÇÃO REAL\n";
            $content .= "# IMPORTANTE: Nunca commite este arquivo no Git!\n\n";

            $content .= "# Ambiente da aplicação\n";
            $content .= "APP_ENV=" . $settings['APP_ENV'] . "\n";
            $content .= "APP_DEBUG=" . $settings['APP_DEBUG'] . "\n";
            $content .= "APP_URL=" . $settings['APP_URL'] . "\n\n";

            $content .= "# Banco de dados\n";
            $content .= "DB_HOST=" . $settings['DB_HOST'] . "\n";
            $content .= "DB_NAME=" . $settings['DB_NAME'] . "\n";
            $content .= "DB_USER=" . $settings['DB_USER'] . "\n";
            $content .= "DB_PASS=" . $settings['DB_PASS'] . "\n\n";

            $content .= "# Email (para formulários de contato)\n";
            $content .= "MAIL_HOST=" . $settings['MAIL_HOST'] . "\n";
            $content .= "MAIL_PORT=" . $settings['MAIL_PORT'] . "\n";
            $content .= "MAIL_USERNAME=" . $settings['MAIL_USERNAME'] . "\n";
            $content .= "MAIL_PASSWORD=" . $settings['MAIL_PASSWORD'] . "\n";
            $content .= "MAIL_ENCRYPTION=" . $settings['MAIL_ENCRYPTION'] . "\n";
            $content .= "MAIL_FROM_ADDRESS=" . $settings['MAIL_FROM_ADDRESS'] . "\n\n";

            $content .= "# Segurança\n";
            $content .= "CSRF_TOKEN_SECRET=" . bin2hex(random_bytes(16)) . "\n";

            // Salvar arquivo
            file_put_contents($env_file, $content);

            header('Location: /admin/settings?success=Configurações salvas com sucesso');
            exit;

        } catch (Exception $e) {
            header('Location: /admin/settings?error=Erro ao salvar configurações');
            exit;
        }
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /admin/login');
            exit;
        }
    }
}
