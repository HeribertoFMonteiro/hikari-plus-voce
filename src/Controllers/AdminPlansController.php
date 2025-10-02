<?php
/**
 * AdminPlansController.php
 * Controlador para gerenciamento de planos
 */

class AdminPlansController
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
            $stmt = $this->pdo->query('SELECT * FROM planos ORDER BY preco ASC');
            $planos = $stmt->fetchAll();

            include __DIR__ . '/../Views/admin/planos/index.php';
        } catch (Exception $e) {
            $error = 'Erro ao carregar planos: ' . $e->getMessage();
            include __DIR__ . '/../Views/admin/planos/index.php';
        }
    }

    public function create()
    {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->save();
        } else {
            include __DIR__ . '/../Views/admin/planos/form.php';
        }
    }

    public function edit($id)
    {
        $this->checkAuth();

        try {
            $stmt = $this->pdo->prepare('SELECT * FROM planos WHERE id = ?');
            $stmt->execute([$id]);
            $plano = $stmt->fetch();

            if (!$plano) {
                header('Location: /admin/planos');
                exit;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->save($id);
            } else {
                include __DIR__ . '/../Views/admin/planos/form.php';
            }
        } catch (Exception $e) {
            header('Location: /admin/planos');
            exit;
        }
    }

    public function delete($id)
    {
        $this->checkAuth();

        try {
            $stmt = $this->pdo->prepare('DELETE FROM planos WHERE id = ?');
            $stmt->execute([$id]);

            header('Location: /admin/planos?success=Plano excluído com sucesso');
        } catch (Exception $e) {
            header('Location: /admin/planos?error=Erro ao excluir plano');
        }
        exit;
    }

    private function save($id = null)
    {
        try {
            $nome = $_POST['nome'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $preco = floatval($_POST['preco'] ?? 0);
            $velocidade = $_POST['velocidade'] ?? '';
            $destaque = isset($_POST['destaque']) ? 1 : 0;

            if ($id) {
                // Update
                $stmt = $this->pdo->prepare('UPDATE planos SET nome = ?, descricao = ?, preco = ?, velocidade = ?, destaque = ? WHERE id = ?');
                $stmt->execute([$nome, $descricao, $preco, $velocidade, $destaque, $id]);
                $message = 'Plano atualizado com sucesso';
            } else {
                // Insert
                $stmt = $this->pdo->prepare('INSERT INTO planos (nome, descricao, preco, velocidade, destaque) VALUES (?, ?, ?, ?, ?)');
                $stmt->execute([$nome, $descricao, $preco, $velocidade, $destaque]);
                $message = 'Plano criado com sucesso';
            }

            header('Location: /admin/planos?success=' . urlencode($message));
            exit;

        } catch (Exception $e) {
            header('Location: /admin/planos?error=Erro ao salvar plano');
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
