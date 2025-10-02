<?php
// Usar o layout admin
ob_start();

// Determinar se é criação ou edição
$isEdit = isset($translation);
$action = $isEdit ? '/admin/traductions/edit/' . $translation['id'] : '/admin/traductions/create';
?>

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-6">
            <a href="/admin/traductions" class="text-indigo-600 hover:text-indigo-800 mr-4">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            <h1 class="text-2xl font-bold text-gray-900">
                <?php echo $isEdit ? 'Editar Tradução' : 'Nova Tradução'; ?>
            </h1>
        </div>

        <form method="POST" action="<?php echo $action; ?>">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="chave" class="block text-sm font-medium text-gray-700 mb-2">
                        Chave de Tradução *
                    </label>
                    <input type="text" id="chave" name="chave" required
                           value="<?php echo $isEdit ? htmlspecialchars($translation['chave']) : ''; ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Ex: titulo_hero">
                    <p class="text-sm text-gray-500 mt-1">
                        Use apenas letras, números e underscore
                    </p>
                </div>

                <div>
                    <label for="pt" class="block text-sm font-medium text-gray-700 mb-2">
                        Texto em Português *
                    </label>
                    <input type="text" id="pt" name="pt" required
                           value="<?php echo $isEdit ? htmlspecialchars($translation['pt']) : ''; ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Texto em português">
                </div>

                <div class="md:col-span-2">
                    <label for="es" class="block text-sm font-medium text-gray-700 mb-2">
                        Texto em Español *
                    </label>
                    <input type="text" id="es" name="es" required
                           value="<?php echo $isEdit ? htmlspecialchars($translation['es']) : ''; ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Texto em español">
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded p-4 mt-6">
                <h4 class="text-sm font-medium text-blue-800 mb-2">Como usar:</h4>
                <p class="text-sm text-blue-600">
                    Use esta chave no código: <code class="bg-blue-100 px-2 py-1 rounded">$translations['<?php echo $isEdit ? $translation['chave'] : 'sua_chave'; ?>']</code>
                </p>
            </div>

            <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                <a href="/admin/traductions"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                    Cancelar
                </a>
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                    <?php echo $isEdit ? 'Atualizar Tradução' : 'Criar Tradução'; ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
