<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Hikari + Você</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .admin-sidebar {
            transition: transform 0.3s ease;
        }
        .admin-sidebar.closed {
            transform: translateX(-100%);
        }
        @media (min-width: 768px) {
            .admin-sidebar {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div id="sidebar" class="admin-sidebar fixed md:static inset-y-0 left-0 z-50 w-64 bg-indigo-800 text-white transform md:transform-none">
        <div class="flex items-center justify-center h-16 bg-indigo-900">
            <h1 class="text-xl font-bold">Admin Panel</h1>
        </div>

        <nav class="mt-8">
            <div class="px-4 space-y-2">
                <a href="/admin/dashboard" class="flex items-center px-4 py-2 text-white hover:bg-indigo-700 rounded <?php echo (strpos($_SERVER['REQUEST_URI'], '/admin/dashboard') !== false) ? 'bg-indigo-700' : ''; ?>">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>

                <a href="/admin/planos" class="flex items-center px-4 py-2 text-white hover:bg-indigo-700 rounded <?php echo (strpos($_SERVER['REQUEST_URI'], '/admin/planos') !== false) ? 'bg-indigo-700' : ''; ?>">
                    <i class="fas fa-list mr-3"></i>
                    Planos
                </a>

                <a href="/admin/blog" class="flex items-center px-4 py-2 text-white hover:bg-indigo-700 rounded <?php echo (strpos($_SERVER['REQUEST_URI'], '/admin/blog') !== false) ? 'bg-indigo-700' : ''; ?>">
                    <i class="fas fa-blog mr-3"></i>
                    Blog
                </a>

                <a href="/admin/traductions" class="flex items-center px-4 py-2 text-white hover:bg-indigo-700 rounded <?php echo (strpos($_SERVER['REQUEST_URI'], '/admin/traductions') !== false) ? 'bg-indigo-700' : ''; ?>">
                    <i class="fas fa-language mr-3"></i>
                    Traduções
                </a>

                <a href="/admin/leads" class="flex items-center px-4 py-2 text-white hover:bg-indigo-700 rounded <?php echo (strpos($_SERVER['REQUEST_URI'], '/admin/leads') !== false) ? 'bg-indigo-700' : ''; ?>">
                    <i class="fas fa-users mr-3"></i>
                    Leads
                </a>

                <a href="/admin/settings" class="flex items-center px-4 py-2 text-white hover:bg-indigo-700 rounded <?php echo (strpos($_SERVER['REQUEST_URI'], '/admin/settings') !== false) ? 'bg-indigo-700' : ''; ?>">
                    <i class="fas fa-cog mr-3"></i>
                    Configurações
                </a>
                    <a href="/" class="flex items-center px-4 py-2 text-indigo-300 hover:bg-indigo-700 rounded" target="_blank">
                        <i class="fas fa-external-link-alt mr-3"></i>
                        Ver Site
                    </a>

                    <a href="/admin/logout" class="flex items-center px-4 py-2 text-red-300 hover:bg-indigo-700 rounded">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Sair
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="md:ml-64">
        <!-- Top Bar -->
        <div class="bg-white shadow-sm border-b">
            <div class="flex items-center justify-between px-4 py-3">
                <div class="flex items-center">
                    <button id="sidebarToggle" class="md:hidden mr-3 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h2 class="text-xl font-semibold text-gray-800">
                        <?php
                        $uri = $_SERVER['REQUEST_URI'];
                        if (strpos($uri, '/admin/dashboard') !== false) echo 'Dashboard';
                        elseif (strpos($uri, '/admin/planos') !== false) echo 'Gerenciar Planos';
                        elseif (strpos($uri, '/admin/blog') !== false) echo 'Gerenciar Blog';
                        elseif (strpos($uri, '/admin/traductions') !== false) echo 'Gerenciar Traduções';
                        elseif (strpos($uri, '/admin/leads') !== false) echo 'Gerenciar Leads';
                        else echo 'Painel Administrativo';
                        ?>
                    </h2>
                </div>

                <div class="flex items-center">
                    <span class="text-sm text-gray-600 mr-2">Olá, <?php echo $_SESSION['admin_nome'] ?? 'Admin'; ?></span>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-6">
            <?php if (isset($_GET['success'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($_GET['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <!-- Conteúdo específico da página -->
            <?php echo $content ?? ''; ?>
        </div>
    </div>

    <script>
        // Toggle sidebar no mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('closed');
        });

        // Fechar sidebar quando clicar fora (mobile)
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');

            if (window.innerWidth < 768 && !sidebar.contains(event.target) && !toggle.contains(event.target)) {
                sidebar.classList.add('closed');
            }
        });
    </script>
</body>
</html>
