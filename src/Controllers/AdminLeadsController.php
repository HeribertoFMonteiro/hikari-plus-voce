<?php
/**
 * AdminLeadsController.php
 * Controlador para gerenciamento de leads/contatos
 */

class AdminLeadsController
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
            $stmt = $this->pdo->query('SELECT * FROM leads ORDER BY criado_em DESC');
            $leads = $stmt->fetchAll();

            include __DIR__ . '/../Views/admin/leads/index.php';
        } catch (Exception $e) {
            $error = 'Erro ao carregar leads: ' . $e->getMessage();
            include __DIR__ . '/../Views/admin/leads/index.php';
        }
    }

    public function view($id)
    {
        $this->checkAuth();

        try {
            $stmt = $this->pdo->prepare('SELECT * FROM leads WHERE id = ?');
            $stmt->execute([$id]);
            $lead = $stmt->fetch();

            if (!$lead) {
                header('Location: /admin/leads');
                exit;
            }

            include __DIR__ . '/../Views/admin/leads/view.php';
        } catch (Exception $e) {
            header('Location: /admin/leads');
            exit;
        }
    }

    public function delete($id)
    {
        $this->checkAuth();

        try {
            $stmt = $this->pdo->prepare('DELETE FROM leads WHERE id = ?');
            $stmt->execute([$id]);

            header('Location: /admin/leads?success=Lead excluído com sucesso');
        } catch (Exception $e) {
            header('Location: /admin/leads?error=Erro ao excluir lead');
        }
        exit;
    }

    public function markAsContacted($id)
    {
        $this->checkAuth();

        try {
            $stmt = $this->pdo->prepare('UPDATE leads SET contacted = 1, contacted_at = NOW() WHERE id = ?');
            $stmt->execute([$id]);

            header('Location: /admin/leads?success=Lead marcado como contactado');
        } catch (Exception $e) {
            header('Location: /admin/leads?error=Erro ao atualizar lead');
        }
        exit;
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /admin/login');
            exit;
        }
    }
}
