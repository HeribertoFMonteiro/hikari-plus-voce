<?php
/**
 * Router.php
 * Sistema de roteamento simples para o MVC
 */

require_once __DIR__ . '/Performance.php';

class Router
{
    private $routes = [];
    private $pdo;
    private $performance;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->performance = Performance::getInstance();

        // Definir rotas
        $this->routes = [
            '/' => ['controller' => 'HomeController', 'action' => 'index'],
            '/index.php' => ['controller' => 'HomeController', 'action' => 'index'],
            '/planos.php' => ['controller' => 'PlanosController', 'action' => 'index'],
            '/about.php' => ['controller' => 'AboutController', 'action' => 'index'],
            '/contato.php' => ['controller' => 'ContatoController', 'action' => 'index'],
            '/cobertura.php' => ['controller' => 'CoberturaController', 'action' => 'index'],
            '/blog.php' => ['controller' => 'BlogController', 'action' => 'index'],
            '/post.php' => ['controller' => 'PostController', 'action' => 'index'],
            '/como-funciona.php' => ['controller' => 'ComoFuncionaController', 'action' => 'index'],
            '/faq.php' => ['controller' => 'FaqController', 'action' => 'index'],
        ];
    }

    public function dispatch($requestUri)
    {
        // Iniciar otimização de performance
        $this->performance->startOutputBuffering();

        // Verificar se há um parâmetro 'page' na query string
        $page = $_GET['page'] ?? null;

        if ($page) {
            // Mapear páginas para controladores
            $pageMap = [
                'planos' => ['controller' => 'PlanosController', 'action' => 'index'],
                'about' => ['controller' => 'AboutController', 'action' => 'index'],
                'contato' => ['controller' => 'ContatoController', 'action' => 'index'],
                'cobertura' => ['controller' => 'CoberturaController', 'action' => 'index'],
                'blog' => ['controller' => 'BlogController', 'action' => 'index'],
                'post' => ['controller' => 'PostController', 'action' => 'index'],
                'como-funciona' => ['controller' => 'ComoFuncionaController', 'action' => 'index'],
                'faq' => ['controller' => 'FaqController', 'action' => 'index'],
            ];

            if (array_key_exists($page, $pageMap)) {
                $route = $pageMap[$page];
            } else {
                $this->show404();
                return;
            }
        } else {
            // Remover query string da URI para rotas diretas
            $path = parse_url($requestUri, PHP_URL_PATH);

            // Verificar se a rota existe
            if (array_key_exists($path, $this->routes)) {
                $route = $this->routes[$path];
            } else {
                // Default para HomeController
                $route = ['controller' => 'HomeController', 'action' => 'index'];
            }
        }

        $controllerName = $route['controller'];
        $action = $route['action'];

        // Incluir o controlador
        $controllerPath = __DIR__ . '/Controllers/' . $controllerName . '.php';
        if (file_exists($controllerPath)) {
            require_once $controllerPath;

            // Instanciar o controlador
            $controller = new $controllerName($this->pdo);

            // Chamar a ação
            if (method_exists($controller, $action)) {
                $controller->$action();

                // Finalizar otimização de performance
                $this->performance->endOutputBuffering();

            } else {
                $this->show404();
            }
        } else {
            $this->show404();
        }
    }

    private function show404()
    {
        header('HTTP/1.0 404 Not Found');
        echo '<h1>404 - Página não encontrada</h1>';
        echo '<p>A página que você está procurando não existe.</p>';
        echo '<a href="/">Voltar ao início</a>';

        // Finalizar otimização mesmo em erro
        $this->performance->endOutputBuffering();
    }
}
?>
