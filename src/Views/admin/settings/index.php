<?php
// Usar o layout admin
ob_start();

// Carregar configurações atuais se não foram passadas
$settings = $settings ?? $_ENV ?? [];
?>

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-6">
            <a href="/admin/dashboard" class="text-indigo-600 hover:text-indigo-800 mr-4">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            <h1 class="text-2xl font-bold text-gray-900">
                Configurações do Sistema
            </h1>
        </div>

        <form method="POST" action="/admin/settings">
            <!-- Ambiente da Aplicação -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Ambiente da Aplicação</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="app_env" class="block text-sm font-medium text-gray-700 mb-2">
                            Ambiente
                        </label>
                        <select id="app_env" name="app_env"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="development" <?php echo ($settings['APP_ENV'] ?? 'production') === 'development' ? 'selected' : ''; ?>>
                                Desenvolvimento
                            </option>
                            <option value="production" <?php echo ($settings['APP_ENV'] ?? 'production') === 'production' ? 'selected' : ''; ?>>
                                Produção
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="app_debug" class="block text-sm font-medium text-gray-700 mb-2">
                            Debug Mode
                        </label>
                        <input type="checkbox" id="app_debug" name="app_debug" value="1"
                               <?php echo ($settings['APP_DEBUG'] ?? 'false') === 'true' ? 'checked' : ''; ?>
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="app_debug" class="ml-2 text-sm text-gray-700">Habilitar debug</label>
                    </div>

                    <div>
                        <label for="app_url" class="block text-sm font-medium text-gray-700 mb-2">
                            URL do Site
                        </label>
                        <input type="url" id="app_url" name="app_url"
                               value="<?php echo htmlspecialchars($settings['APP_URL'] ?? 'https://hikari-voce.com'); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="https://hikari-voce.com">
                    </div>
                </div>
            </div>

            <!-- Banco de Dados -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Banco de Dados</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="db_host" class="block text-sm font-medium text-gray-700 mb-2">
                            Host
                        </label>
                        <input type="text" id="db_host" name="db_host"
                               value="<?php echo htmlspecialchars($settings['DB_HOST'] ?? 'localhost'); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="localhost">
                    </div>

                    <div>
                        <label for="db_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome do Banco
                        </label>
                        <input type="text" id="db_name" name="db_name"
                               value="<?php echo htmlspecialchars($settings['DB_NAME'] ?? 'hikari_plus_voce'); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="hikari_plus_voce">
                    </div>

                    <div>
                        <label for="db_user" class="block text-sm font-medium text-gray-700 mb-2">
                            Usuário
                        </label>
                        <input type="text" id="db_user" name="db_user"
                               value="<?php echo htmlspecialchars($settings['DB_USER'] ?? 'hikari_user'); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="hikari_user">
                    </div>

                    <div>
                        <label for="db_pass" class="block text-sm font-medium text-gray-700 mb-2">
                            Senha
                        </label>
                        <input type="password" id="db_pass" name="db_pass"
                               value="<?php echo htmlspecialchars($settings['DB_PASS'] ?? ''); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Sua senha do banco">
                    </div>
                </div>
            </div>

            <!-- Configurações de Email -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Configurações de Email</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="mail_host" class="block text-sm font-medium text-gray-700 mb-2">
                            SMTP Host
                        </label>
                        <input type="text" id="mail_host" name="mail_host"
                               value="<?php echo htmlspecialchars($settings['MAIL_HOST'] ?? 'smtp.gmail.com'); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="smtp.gmail.com">
                    </div>

                    <div>
                        <label for="mail_port" class="block text-sm font-medium text-gray-700 mb-2">
                            Porta
                        </label>
                        <input type="number" id="mail_port" name="mail_port"
                               value="<?php echo htmlspecialchars($settings['MAIL_PORT'] ?? '587'); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="587">
                    </div>

                    <div>
                        <label for="mail_username" class="block text-sm font-medium text-gray-700 mb-2">
                            Usuário/Email
                        </label>
                        <input type="email" id="mail_username" name="mail_username"
                               value="<?php echo htmlspecialchars($settings['MAIL_USERNAME'] ?? 'contato@hikari-voce.com'); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="contato@hikari-voce.com">
                    </div>

                    <div>
                        <label for="mail_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Senha App
                        </label>
                        <input type="password" id="mail_password" name="mail_password"
                               value="<?php echo htmlspecialchars($settings['MAIL_PASSWORD'] ?? ''); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Sua senha de app">
                    </div>

                    <div>
                        <label for="mail_encryption" class="block text-sm font-medium text-gray-700 mb-2">
                            Encriptação
                        </label>
                        <select id="mail_encryption" name="mail_encryption"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="tls" <?php echo ($settings['MAIL_ENCRYPTION'] ?? 'tls') === 'tls' ? 'selected' : ''; ?>>TLS</option>
                            <option value="ssl" <?php echo ($settings['MAIL_ENCRYPTION'] ?? 'tls') === 'ssl' ? 'selected' : ''; ?>>SSL</option>
                        </select>
                    </div>

                    <div>
                        <label for="mail_from_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Remetente
                        </label>
                        <input type="email" id="mail_from_address" name="mail_from_address"
                               value="<?php echo htmlspecialchars($settings['MAIL_FROM_ADDRESS'] ?? 'contato@hikari-voce.com'); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="contato@hikari-voce.com">
                    </div>
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded p-4 mb-6">
                <h4 class="text-sm font-medium text-yellow-800 mb-2">⚠️ Atenção:</h4>
                <p class="text-sm text-yellow-700">
                    Alterar essas configurações pode afetar o funcionamento do site.
                    Certifique-se de que tem backups e teste as alterações.
                </p>
            </div>

            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="/admin/dashboard"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                    Cancelar
                </a>
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg"
                        onclick="return confirm('Tem certeza que deseja salvar essas configurações?')">
                    <i class="fas fa-save mr-2"></i>Salvar Configurações
                </button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
