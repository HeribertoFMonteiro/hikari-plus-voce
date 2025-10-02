<?php
// Usar o layout admin
ob_start();
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card: Total Leads -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 bg-blue-500 rounded-lg">
                <i class="fas fa-users text-white"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Leads</p>
                <p class="text-2xl font-semibold text-gray-900"><?php echo $stats['leads'] ?? 0; ?></p>
            </div>
        </div>
    </div>

    <!-- Card: Total Planos -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 bg-green-500 rounded-lg">
                <i class="fas fa-list text-white"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Planos Ativos</p>
                <p class="text-2xl font-semibold text-gray-900"><?php echo $stats['planos'] ?? 0; ?></p>
            </div>
        </div>
    </div>

    <!-- Card: Posts Blog -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 bg-purple-500 rounded-lg">
                <i class="fas fa-blog text-white"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Posts Blog</p>
                <p class="text-2xl font-semibold text-gray-900"><?php echo $stats['posts'] ?? 0; ?></p>
            </div>
        </div>
    </div>

    <!-- Card: Traduções -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-2 bg-yellow-500 rounded-lg">
                <i class="fas fa-language text-white"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Traduções</p>
                <p class="text-2xl font-semibold text-gray-900"><?php echo $stats['translations'] ?? 0; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Leads Recentes -->
<div class="bg-white rounded-lg shadow mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Leads Recentes</h3>
    </div>
    <div class="p-6">
        <?php if (!empty($recent_leads)): ?>
            <div class="space-y-4">
                <?php foreach ($recent_leads as $lead): ?>
                    <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                        <div>
                            <p class="font-medium text-gray-900"><?php echo htmlspecialchars($lead['nome']); ?></p>
                            <p class="text-sm text-gray-600"><?php echo htmlspecialchars($lead['email']); ?></p>
                            <p class="text-xs text-gray-500"><?php echo date('d/m/Y H:i', strtotime($lead['criado_em'])); ?></p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="/admin/leads/view/<?php echo $lead['id']; ?>"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                Ver
                            </a>
                            <?php if (!$lead['contacted']): ?>
                                <a href="/admin/leads/contacted/<?php echo $lead['id']; ?>"
                                   class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                    Contactar
                                </a>
                            <?php else: ?>
                                <span class="bg-gray-400 text-white px-3 py-1 rounded text-sm">Contactado</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500 text-center py-4">Nenhum lead recente</p>
        <?php endif; ?>
    </div>
</div>

<!-- Erros Recentes -->
<?php if (!empty($recent_errors)): ?>
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Erros Recentes</h3>
    </div>
    <div class="p-6">
        <div class="space-y-2">
            <?php foreach ($recent_errors as $error): ?>
                <div class="text-sm text-red-600 font-mono bg-red-50 p-2 rounded">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
