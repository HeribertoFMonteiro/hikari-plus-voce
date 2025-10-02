<?php
/**
 * BlogController.php
 * Controlador para a página do blog
 */

class BlogController
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

        // Buscar posts publicados
        $stmt = $this->pdo->prepare("SELECT * FROM blog_posts WHERE idioma = ? AND publicado = 1 ORDER BY criado_em DESC");
        $stmt->execute([$idioma]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Incluir header
        include __DIR__ . '/../Views/header.php';

        // Incluir view
        require __DIR__ . '/../Views/blog.php';

        // Incluir footer
        include __DIR__ . '/../Views/footer.php';
    }
}
?>
