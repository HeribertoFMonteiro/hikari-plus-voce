<?php
/**
 * AdminBlogController.php
 * Controlador para gerenciamento de posts do blog
 */

class AdminBlogController
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
            $stmt = $this->pdo->query('SELECT * FROM blog_posts ORDER BY criado_em DESC');
            $posts = $stmt->fetchAll();

            include __DIR__ . '/../Views/admin/blog/index.php';
        } catch (Exception $e) {
            $error = 'Erro ao carregar posts: ' . $e->getMessage();
            include __DIR__ . '/../Views/admin/blog/index.php';
        }
    }

    public function create()
    {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->save();
        } else {
            include __DIR__ . '/../Views/admin/blog/form.php';
        }
    }

    public function edit($id)
    {
        $this->checkAuth();

        try {
            $stmt = $this->pdo->prepare('SELECT * FROM blog_posts WHERE id = ?');
            $stmt->execute([$id]);
            $post = $stmt->fetch();

            if (!$post) {
                header('Location: /admin/blog');
                exit;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->save($id);
            } else {
                include __DIR__ . '/../Views/admin/blog/form.php';
            }
        } catch (Exception $e) {
            header('Location: /admin/blog');
            exit;
        }
    }

    public function delete($id)
    {
        $this->checkAuth();

        try {
            $stmt = $this->pdo->prepare('DELETE FROM blog_posts WHERE id = ?');
            $stmt->execute([$id]);

            header('Location: /admin/blog?success=Post excluído com sucesso');
        } catch (Exception $e) {
            header('Location: /admin/blog?error=Erro ao excluir post');
        }
        exit;
    }

    private function save($id = null)
    {
        try {
            $titulo = $_POST['titulo'] ?? '';
            $conteudo = $_POST['conteudo'] ?? '';
            $slug = $this->createSlug($titulo);
            $publicado = isset($_POST['publicado']) ? 1 : 0;

            if ($id) {
                // Update
                $stmt = $this->pdo->prepare('UPDATE blog_posts SET titulo = ?, conteudo = ?, slug = ?, publicado = ? WHERE id = ?');
                $stmt->execute([$titulo, $conteudo, $slug, $publicado, $id]);
                $message = 'Post atualizado com sucesso';
            } else {
                // Insert
                $stmt = $this->pdo->prepare('INSERT INTO blog_posts (titulo, conteudo, slug, publicado) VALUES (?, ?, ?, ?)');
                $stmt->execute([$titulo, $conteudo, $slug, $publicado]);
                $message = 'Post criado com sucesso';
            }

            header('Location: /admin/blog?success=' . urlencode($message));
            exit;

        } catch (Exception $e) {
            header('Location: /admin/blog?error=Erro ao salvar post');
            exit;
        }
    }

    private function createSlug($titulo)
    {
        $slug = strtolower(trim($titulo));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        return trim($slug, '-');
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /admin/login');
            exit;
        }
    }
}
