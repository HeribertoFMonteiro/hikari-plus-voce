<?php
/**
 * PostController.php
 * Controlador para posts individuais do blog
 */

class PostController
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
        $slug = $_GET['slug'] ?? '';

        $stmt = $this->pdo->prepare("SELECT chave, $idioma AS texto FROM translations");
        $stmt->execute();
        $translations = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        // Buscar post específico
        $stmt = $this->pdo->prepare("SELECT * FROM blog_posts WHERE slug = ? AND idioma = ? AND publicado = 1");
        $stmt->execute([$slug, $idioma]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$post) {
            header('Location: blog.php?lang=' . $idioma);
            exit;
        }

        // Incluir header
        include __DIR__ . '/../Views/header.php';

        // Incluir view
        require __DIR__ . '/../Views/post.php';

        // Incluir footer
        include __DIR__ . '/../Views/footer.php';
    }
}
?>
