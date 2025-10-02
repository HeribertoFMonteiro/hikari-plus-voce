<?php
/**
 * AdminTranslationsController.php
 * Controlador para gerenciamento de traduções
 */

class AdminTranslationsController
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
            $stmt = $this->pdo->query('SELECT * FROM translations ORDER BY chave ASC');
            $translations = $stmt->fetchAll();

            include __DIR__ . '/../Views/admin/translations/index.php';
        } catch (Exception $e) {
            $error = 'Erro ao carregar traduções: ' . $e->getMessage();
            include __DIR__ . '/../Views/admin/translations/index.php';
        }
    }

    public function create()
    {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->save();
        } else {
            include __DIR__ . '/../Views/admin/translations/form.php';
        }
    }

    public function edit($id)
    {
        $this->checkAuth();

        try {
            $stmt = $this->pdo->prepare('SELECT * FROM translations WHERE id = ?');
            $stmt->execute([$id]);
            $translation = $stmt->fetch();

            if (!$translation) {
                header('Location: /admin/traductions');
                exit;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->save($id);
            } else {
                include __DIR__ . '/../Views/admin/translations/form.php';
            }
        } catch (Exception $e) {
            header('Location: /admin/traductions');
            exit;
        }
    }

    public function delete($id)
    {
        $this->checkAuth();

        try {
            $stmt = $this->pdo->prepare('DELETE FROM translations WHERE id = ?');
            $stmt->execute([$id]);

            header('Location: /admin/traductions?success=Tradução excluída com sucesso');
        } catch (Exception $e) {
            header('Location: /admin/traductions?error=Erro ao excluir tradução');
        }
        exit;
    }

    private function save($id = null)
    {
        try {
            $chave = $_POST['chave'] ?? '';
            $pt = $_POST['pt'] ?? '';
            $es = $_POST['es'] ?? '';

            if ($id) {
                // Update
                $stmt = $this->pdo->prepare('UPDATE translations SET chave = ?, pt = ?, es = ? WHERE id = ?');
                $stmt->execute([$chave, $pt, $es, $id]);
                $message = 'Tradução atualizada com sucesso';
            } else {
                // Insert
                $stmt = $this->pdo->prepare('INSERT INTO translations (chave, pt, es) VALUES (?, ?, ?)');
                $stmt->execute([$chave, $pt, $es]);
                $message = 'Tradução criada com sucesso';
            }

            header('Location: /admin/traductions?success=' . urlencode($message));
            exit;

        } catch (Exception $e) {
            header('Location: /admin/traductions?error=Erro ao salvar tradução');
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
