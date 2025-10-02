<?php
// index.php - Front Controller
require_once '../src/Models/Database.php';
require_once '../src/Router.php';
require_once '../src/AdminRouter.php';

// Initialize database connection
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

// Verificar se é uma rota administrativa
$adminRouter = new AdminRouter($pdo);
if (!$adminRouter->dispatch($_SERVER['REQUEST_URI'])) {
    // Criar instância do roteador normal
    $router = new Router($pdo);

    // Processar a requisição
    $router->dispatch($_SERVER['REQUEST_URI']);
}
?>
