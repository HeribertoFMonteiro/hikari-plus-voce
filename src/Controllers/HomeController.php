<?php
/**
 * HomeController.php
 * Controlador para a página inicial
 */

class HomeController
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

        // Buscar planos em destaque
        $stmt = $this->pdo->query("SELECT * FROM planos WHERE destaque = 1 ORDER BY preco ASC");
        $planosDestaque = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Incluir header
        include __DIR__ . '/../Views/header.php';

        // Incluir view
        require __DIR__ . '/../Views/home.php';

        // Incluir footer
        include __DIR__ . '/../Views/footer.php';
    }
}
?>
