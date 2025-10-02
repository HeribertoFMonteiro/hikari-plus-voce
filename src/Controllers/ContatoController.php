<?php
/**
 * ContatoController.php
 * Controlador para a página de contato
 */

class ContatoController
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

        // Processar formulário
        $mensagem = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar rate limiting
            $clientIP = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            $security = Security::getInstance();

            if (!$security->checkRateLimit("contact_form_{$clientIP}")) {
                $mensagem = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">Muitas tentativas. Tente novamente em alguns minutos.</div>';
            } else {
                // Sanitizar e validar entradas
                $nome = $security->sanitizeString($_POST['nome'] ?? '');
                $email = $security->sanitizeEmail($_POST['email'] ?? '');
                $telefone = $security->sanitizeString($_POST['telefone'] ?? '');
                $plano = $security->sanitizeString($_POST['plano'] ?? '');
                $mensagem_form = $security->sanitizeString($_POST['mensagem'] ?? '');

                // Validar campos obrigatórios
                $errors = [];

                if (empty($nome) || strlen($nome) < 2) {
                    $errors[] = 'Nome deve ter pelo menos 2 caracteres';
                }

                if (empty($email) || !$security->validateEmail($email)) {
                    $errors[] = 'Email inválido';
                }

                if (empty($mensagem_form) || strlen($mensagem_form) < 10) {
                    $errors[] = 'Mensagem deve ter pelo menos 10 caracteres';
                }

                if (empty($errors)) {
                    try {
                        $stmt = $this->pdo->prepare("INSERT INTO leads (nome, email, telefone, plano_interesse, mensagem, idioma, ip_address, criado_em) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
                        $stmt->execute([$nome, $email, $telefone, $plano, $mensagem_form, $idioma, $clientIP]);

                        $mensagem = '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">Mensagem enviada com sucesso! Entraremos em contato em breve.</div>';

                        // Log da submissão bem-sucedida
                        Logger::getInstance()->info("Contact form submitted successfully", [
                            'email' => $email,
                            'ip' => $clientIP
                        ]);

                    } catch (PDOException $e) {
                        Logger::getInstance()->error("Failed to save contact form", [
                            'error' => $e->getMessage(),
                            'email' => $email
                        ]);
                        $mensagem = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">Erro ao enviar mensagem. Tente novamente.</div>';
                    }
                } else {
                    $mensagem = '<div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">' . implode('<br>', $errors) . '</div>';
                }
            }
        }

        // Incluir header
        include __DIR__ . '/../Views/header.php';

        // Incluir view
        require __DIR__ . '/../Views/contato.php';

        // Incluir footer
        include __DIR__ . '/../Views/footer.php';
    }
}
?>
