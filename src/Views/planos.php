<?php
// planos.php - View for PlanosController
?>

<section class="bg-gray-50 py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-4xl sm:text-5xl font-extrabold text-indigo-700 mb-4">
      <?php echo $translations['planos'] ?? 'Planos'; ?>
    </h1>
    <p class="text-lg text-gray-600 mb-12">
      <?php echo $translations['bem_vindo'] ?? 'Escolha o plano perfeito para você e sua família.'; ?>
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <?php foreach ($planos as $plano): ?>
        <?php
          $destaque = $plano['destaque'] ? 'border-2 border-indigo-600 hover:shadow-2xl transform scale-105' : 'border border-gray-200 hover:shadow-xl';
          $beneficios = explode(';', $plano['beneficios']);
        ?>
        <div class="bg-white shadow-lg rounded-2xl p-8 <?php echo $destaque; ?> transition">
          <h2 class="text-2xl font-bold text-indigo-600 mb-2"><?php echo $plano['nome']; ?></h2>
          <p class="text-gray-500 mb-6"><?php echo $plano['descricao']; ?></p>
          <p class="text-4xl font-extrabold text-gray-900 mb-6">
            ¥<?php echo number_format($plano['preco'], 0, ',', '.'); ?>
            <span class="text-lg font-medium text-gray-500">/mês</span>
          </p>
          <ul class="space-y-2 text-gray-700 mb-8">
            <li>🚀 Velocidade: <?php echo $plano['velocidade']; ?></li>
            <?php foreach ($beneficios as $b): ?>
              <li>⚡ <?php echo trim($b); ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="/contato.php" class="block bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 font-semibold transition">
            <?php echo $translations['contratar_agora'] ?? 'Contratar Agora'; ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>

    <p class="mt-10 text-sm text-gray-500">
      *Valores sujeitos a disponibilidade de cobertura. Consulte condições e promoções.
    </p>
  </div>
</section>
