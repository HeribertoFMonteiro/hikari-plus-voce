<?php
/**
 * AdminAuthController.php
 * Controlador para autenticação administrativa
 */

class AdminAuthController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function login()
    {
        // Se já estiver logado, redirecionar para dashboard
        if (isset($_SESSION['admin_id'])) {
            header('Location: /admin/dashboard');
            exit;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (!empty($username) && !empty($password)) {
                try {
                    $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE username = ?");
                    $stmt->execute([$username]);
                    $admin = $stmt->fetch();

                    if ($admin && password_verify($password, $admin['password'])) {
                        // Login bem-sucedido
                        $_SESSION['admin_id'] = $admin['id'];
                        $_SESSION['admin_username'] = $admin['username'];
                        $_SESSION['admin_nome'] = $admin['nome'];

                        // Atualizar último login
                        $stmt = $this->pdo->prepare("UPDATE admins SET ultimo_login = NOW() WHERE id = ?");
                        $stmt->execute([$admin['id']]);

                        header('Location: /admin/dashboard');
                        exit;
                    } else {
                        $error = 'Usuário ou senha inválidos';
                    }
                } catch (Exception $e) {
                    $error = 'Erro interno. Tente novamente.';
                }
            } else {
                $error = 'Preencha todos os campos';
            }
        }

        include __DIR__ . '/../Views/admin/login.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: /admin/login');
        exit;
    }

    public function checkAuth()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /admin/login');
            exit;
        }
    }
}
