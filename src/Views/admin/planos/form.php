<?php
// Usar o layout admin
ob_start();

// Determinar se é criação ou edição
$isEdit = isset($plano);
$action = $isEdit ? '/admin/planos/edit/' . $plano['id'] : '/admin/planos/create';
?>

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-6">
            <a href="/admin/planos" class="text-indigo-600 hover:text-indigo-800 mr-4">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            <h1 class="text-2xl font-bold text-gray-900">
                <?php echo $isEdit ? 'Editar Plano' : 'Novo Plano'; ?>
            </h1>
        </div>

        <form method="POST" action="<?php echo $action; ?>">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
                        Nome do Plano *
                    </label>
                    <input type="text" id="nome" name="nome" required
                           value="<?php echo $isEdit ? htmlspecialchars($plano['nome']) : ''; ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Ex: Plano Básico">
                </div>

                <div class="md:col-span-2">
                    <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">
                        Descrição *
                    </label>
                    <textarea id="descricao" name="descricao" rows="4" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                              placeholder="Descreva os benefícios e características do plano"><?php echo $isEdit ? htmlspecialchars($plano['descricao']) : ''; ?></textarea>
                </div>

                <div>
                    <label for="preco" class="block text-sm font-medium text-gray-700 mb-2">
                        Preço (¥) *
                    </label>
                    <input type="number" id="preco" name="preco" step="0.01" required
                           value="<?php echo $isEdit ? $plano['preco'] : ''; ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="3980">
                </div>

                <div>
                    <label for="velocidade" class="block text-sm font-medium text-gray-700 mb-2">
                        Velocidade *
                    </label>
                    <input type="text" id="velocidade" name="velocidade" required
                           value="<?php echo $isEdit ? htmlspecialchars($plano['velocidade']) : ''; ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Ex: 100 Mbps">
                </div>

                <div class="md:col-span-2">
                    <div class="flex items-center">
                        <input type="checkbox" id="destaque" name="destaque" value="1"
                               <?php echo $isEdit && $plano['destaque'] ? 'checked' : ''; ?>
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="destaque" class="ml-2 block text-sm text-gray-900">
                            Marcar como plano em destaque
                        </label>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">
                        Planos em destaque aparecem primeiro na lista
                    </p>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                <a href="/admin/planos"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                    Cancelar
                </a>
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                    <?php echo $isEdit ? 'Atualizar Plano' : 'Criar Plano'; ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
