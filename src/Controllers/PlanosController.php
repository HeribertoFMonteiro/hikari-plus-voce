<?php
/**
 * PlanosController.php
 * Controlador para a página de planos
 */

class PlanosController
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

        // Buscar todos os planos
        $stmt = $this->pdo->query("SELECT * FROM planos ORDER BY preco ASC");
        $planos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Incluir header
        include __DIR__ . '/../Views/header.php';

        // Incluir view
        require __DIR__ . '/../Views/planos.php';

        // Incluir footer
        include __DIR__ . '/../Views/footer.php';
    }
}
?>
