<?php
/**
 * ComoFuncionaController.php
 * Controlador para a página "Como Funciona"
 */

class ComoFuncionaController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        // Buscar traduções
        $idioma = isset($_GET['lang']) && $_GET['lang'] === 'es' ? 'es' : 'pt';
        $stmt = $this->pdo->prepare("SELECT chave, $idioma AS texto FROM translations");
        $stmt->execute();
        $translations = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        // Incluir header
        include __DIR__ . '/../Views/header.php';

        // Incluir view
        require __DIR__ . '/../Views/como-funciona.php';

        // Incluir footer
        include __DIR__ . '/../Views/footer.php';
    }
}
?>
