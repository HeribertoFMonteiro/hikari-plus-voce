<?php
/**
 * AdminDashboardController.php
 * Controlador principal do dashboard administrativo
 */

class AdminDashboardController
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
            // Estatísticas gerais
            $stats = [];

            // Total de leads
            $stmt = $this->pdo->query('SELECT COUNT(*) as total FROM leads');
            $stats['leads'] = $stmt->fetch()['total'];

            // Total de planos
            $stmt = $this->pdo->query('SELECT COUNT(*) as total FROM planos');
            $stats['planos'] = $stmt->fetch()['total'];

            // Total de posts
            $stmt = $this->pdo->query('SELECT COUNT(*) as total FROM blog_posts');
            $stats['posts'] = $stmt->fetch()['total'];

            // Total de traduções
            $stmt = $this->pdo->query('SELECT COUNT(*) as total FROM translations');
            $stats['translations'] = $stmt->fetch()['total'];

            // Leads recentes
            $stmt = $this->pdo->query('SELECT * FROM leads ORDER BY criado_em DESC LIMIT 5');
            $recent_leads = $stmt->fetchAll();

            // Logs de erro recentes
            $log_file = __DIR__ . '/../logs/' . date('Y-m-d') . '.log';
            $recent_errors = [];
            if (file_exists($log_file)) {
                $logs = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $recent_errors = array_slice(array_reverse($logs), 0, 5);
            }

            include __DIR__ . '/../Views/admin/dashboard.php';

        } catch (Exception $e) {
            $error = 'Erro ao carregar dashboard: ' . $e->getMessage();
            include __DIR__ . '/../Views/admin/dashboard.php';
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
