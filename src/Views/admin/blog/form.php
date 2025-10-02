<?php
// Usar o layout admin
ob_start();

// Determinar se é criação ou edição
$isEdit = isset($post);
$action = $isEdit ? '/admin/blog/edit/' . $post['id'] : '/admin/blog/create';
?>

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-6">
            <a href="/admin/blog" class="text-indigo-600 hover:text-indigo-800 mr-4">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            <h1 class="text-2xl font-bold text-gray-900">
                <?php echo $isEdit ? 'Editar Post' : 'Novo Post'; ?>
            </h1>
        </div>

        <form method="POST" action="<?php echo $action; ?>">
            <div class="space-y-6">
                <div>
                    <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">
                        Título do Post *
                    </label>
                    <input type="text" id="titulo" name="titulo" required
                           value="<?php echo $isEdit ? htmlspecialchars($post['titulo']) : ''; ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Digite o título do post">
                </div>

                <div>
                    <label for="conteudo" class="block text-sm font-medium text-gray-700 mb-2">
                        Conteúdo *
                    </label>
                    <textarea id="conteudo" name="conteudo" rows="20" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                              placeholder="Digite o conteúdo do post em HTML"><?php echo $isEdit ? htmlspecialchars($post['conteudo']) : ''; ?></textarea>
                    <p class="text-sm text-gray-500 mt-1">
                        Use HTML para formatação. Será renderizado como conteúdo da página.
                    </p>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="publicado" name="publicado" value="1"
                           <?php echo $isEdit && $post['publicado'] ? 'checked' : ''; ?>
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="publicado" class="ml-2 block text-sm text-gray-900">
                        Publicar imediatamente
                    </label>
                </div>

                <?php if ($isEdit): ?>
                    <div class="bg-blue-50 border border-blue-200 rounded p-4">
                        <h4 class="text-sm font-medium text-blue-800 mb-2">Preview do Slug:</h4>
                        <p class="text-sm text-blue-600 font-mono">
                            <?php echo htmlspecialchars($post['slug']); ?>
                        </p>
                        <p class="text-xs text-blue-500 mt-1">
                            URL: /blog/<?php echo htmlspecialchars($post['slug']); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                <a href="/admin/blog"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                    Cancelar
                </a>
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                    <?php echo $isEdit ? 'Atualizar Post' : 'Criar Post'; ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
