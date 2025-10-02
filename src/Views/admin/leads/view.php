<?php
// Usar o layout admin
ob_start();
?>

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-6">
            <a href="/admin/leads" class="text-indigo-600 hover:text-indigo-800 mr-4">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            <h1 class="text-2xl font-bold text-gray-900">
                Detalhes do Lead
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informações Pessoais</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nome</dt>
                        <dd class="text-sm text-gray-900"><?php echo htmlspecialchars($lead['nome']); ?></dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="text-sm text-gray-900">
                            <a href="mailto:<?php echo htmlspecialchars($lead['email']); ?>" class="text-indigo-600 hover:text-indigo-800">
                                <?php echo htmlspecialchars($lead['email']); ?>
                            </a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Telefone</dt>
                        <dd class="text-sm text-gray-900">
                            <?php if ($lead['telefone']): ?>
                                <a href="tel:<?php echo htmlspecialchars($lead['telefone']); ?>" class="text-indigo-600 hover:text-indigo-800">
                                    <?php echo htmlspecialchars($lead['telefone']); ?>
                                </a>
                            <?php else: ?>
                                <span class="text-gray-400">Não informado</span>
                            <?php endif; ?>
                        </dd>
                    </div>
                </dl>
            </div>

            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informações do Interesse</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Plano de Interesse</dt>
                        <dd class="text-sm text-gray-900">
                            <?php echo htmlspecialchars($lead['plano_interesse'] ?: 'Não especificado'); ?>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Idioma</dt>
                        <dd class="text-sm text-gray-900">
                            <?php echo $lead['idioma'] === 'es' ? 'Español' : 'Português'; ?>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">IP Address</dt>
                        <dd class="text-sm text-gray-900 font-mono"><?php echo htmlspecialchars($lead['ip_address']); ?></dd>
                    </div>
                </dl>
            </div>
        </div>

        <?php if ($lead['mensagem']): ?>
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Mensagem</h3>
                <div class="bg-gray-50 border border-gray-200 rounded p-4">
                    <p class="text-sm text-gray-900 whitespace-pre-wrap"><?php echo htmlspecialchars($lead['mensagem']); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Informações do Sistema</h3>
            <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Data de Cadastro</dt>
                    <dd class="text-sm text-gray-900"><?php echo date('d/m/Y H:i:s', strtotime($lead['criado_em'])); ?></dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="text-sm text-gray-900">
                        <?php if ($lead['contacted']): ?>
                            <span class="inline-flex items-center text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Contactado em <?php echo date('d/m/Y H:i', strtotime($lead['contacted_at'])); ?>
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center text-yellow-800">
                                <i class="fas fa-clock mr-1"></i> Pendente
                            </span>
                        <?php endif; ?>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">ID</dt>
                    <dd class="text-sm text-gray-900 font-mono">#<?php echo $lead['id']; ?></dd>
                </div>
            </dl>
        </div>

        <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
            <div class="flex space-x-3">
                <?php if (!$lead['contacted']): ?>
                    <a href="/admin/leads/contacted/<?php echo $lead['id']; ?>"
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-phone mr-2"></i>Marcar como Contactado
                    </a>
                <?php endif; ?>

                <a href="mailto:<?php echo htmlspecialchars($lead['email']); ?>?subject=Contato%20Hikari%20%2B%20Você"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-envelope mr-2"></i>Enviar Email
                </a>
            </div>

            <a href="/admin/leads/delete/<?php echo $lead['id']; ?>"
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg"
               onclick="return confirm('Tem certeza que deseja excluir este lead?')">
                <i class="fas fa-trash mr-2"></i>Excluir Lead
            </a>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
