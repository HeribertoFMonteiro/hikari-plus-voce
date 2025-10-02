<?php
// contato.php - Contact page using MVC
require_once '../src/Models/Database.php';
require_once '../src/Controllers/ContatoController.php';

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

// Instantiate controller and call index
$controller = new ContatoController($pdo);
$controller->index();
?>
