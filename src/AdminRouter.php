<?php
/**
 * AdminRouter.php
 * Roteador para o painel administrativo
 */

class AdminRouter
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        session_start();
    }

    public function dispatch($requestUri)
    {
        $uri = trim($requestUri, '/');
        $segments = explode('/', $uri);
        $path = $segments[0] ?? '';

        // Verificar se está na área admin
        if ($path !== 'admin') {
            return false;
        }

        // Remover 'admin' do path
        array_shift($segments);
        $adminPath = implode('/', $segments);
        $adminSegments = explode('/', $adminPath);

        $controller = $adminSegments[0] ?? 'dashboard';
        $action = $adminSegments[1] ?? 'index';
        $param = $adminSegments[2] ?? null;

        switch ($controller) {
            case 'login':
                $authController = new AdminAuthController($this->pdo);
                $authController->login();
                break;

            case 'logout':
                $authController = new AdminAuthController($this->pdo);
                $authController->logout();
                break;

            case 'dashboard':
                $dashboardController = new AdminDashboardController($this->pdo);
                $dashboardController->index();
                break;

            case 'planos':
                $plansController = new AdminPlansController($this->pdo);
                if ($action === 'create') {
                    $plansController->create();
                } elseif ($action === 'edit' && $param) {
                    $plansController->edit($param);
                } elseif ($action === 'delete' && $param) {
                    $plansController->delete($param);
                } else {
                    $plansController->index();
                }
                break;

            case 'blog':
                $blogController = new AdminBlogController($this->pdo);
                if ($action === 'create') {
                    $blogController->create();
                } elseif ($action === 'edit' && $param) {
                    $blogController->edit($param);
                } elseif ($action === 'delete' && $param) {
                    $blogController->delete($param);
                } else {
                    $blogController->index();
                }
                break;

            case 'traductions':
                $translationsController = new AdminTranslationsController($this->pdo);
                if ($action === 'create') {
                    $translationsController->create();
                } elseif ($action === 'edit' && $param) {
                    $translationsController->edit($param);
                } elseif ($action === 'delete' && $param) {
                    $translationsController->delete($param);
                } else {
                    $translationsController->index();
                }
                break;

            case 'settings':
                $settingsController = new AdminSettingsController($this->pdo);
                $settingsController->index();
                break;

            default:
                // Verificar autenticação para qualquer rota admin
                $authController = new AdminAuthController($this->pdo);
                $authController->checkAuth();

                // Dashboard padrão
                $dashboardController = new AdminDashboardController($this->pdo);
                $dashboardController->index();
                break;
        }

        return true;
    }
}
