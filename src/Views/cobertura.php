<?php
// cobertura.php - View for CoberturaController
?>

<section class="py-20 bg-gradient-to-br from-green-50 to-blue-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold mb-6 text-center text-indigo-700">
      <?php echo $translations['cobertura'] ?? 'Cobertura'; ?>
    </h1>
    <p class="text-gray-700 text-lg leading-relaxed mb-12 text-center max-w-3xl mx-auto">
      <?php echo $translations['cobertura_texto'] ?? 'A Hikari + Você oferece cobertura em diversas regiões metropolitanas do Japão, garantindo internet de alta velocidade para brasileiros e latinos residentes.'; ?>
    </p>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
      <div class="bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-xl transition">
        <i data-lucide="map-pin" class="w-12 h-12 text-indigo-600 mx-auto mb-4"></i>
        <h3 class="text-2xl font-bold mb-2">Tokyo</h3>
        <p class="text-gray-600 mb-4">
          <?php echo $translations['tokyo_desc'] ?? 'Cobertura completa na região metropolitana de Tokyo, incluindo bairros centrais e subúrbios.'; ?>
        </p>
        <div class="text-sm text-green-600 font-semibold">
          <?php echo $translations['disponivel'] ?? 'Disponível'; ?>
        </div>
      </div>

      <div class="bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-xl transition">
        <i data-lucide="map-pin" class="w-12 h-12 text-indigo-600 mx-auto mb-4"></i>
        <h3 class="text-2xl font-bold mb-2">Osaka</h3>
        <p class="text-gray-600 mb-4">
          <?php echo $translations['osaka_desc'] ?? 'Rede extensa em Osaka e região metropolitana, perfeita para famílias e profissionais.'; ?>
        </p>
        <div class="text-sm text-green-600 font-semibold">
          <?php echo $translations['disponivel'] ?? 'Disponível'; ?>
        </div>
      </div>

      <div class="bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-xl transition">
        <i data-lucide="map-pin" class="w-12 h-12 text-indigo-600 mx-auto mb-4"></i>
        <h3 class="text-2xl font-bold mb-2">Nagoya</h3>
        <p class="text-gray-600 mb-4">
          <?php echo $translations['nagoya_desc'] ?? 'Cobertura em expansão na região de Nagoya, com velocidades de até 1 Gbps.'; ?>
        </p>
        <div class="text-sm text-yellow-600 font-semibold">
          <?php echo $translations['expansao'] ?? 'Em Expansão'; ?>
        </div>
      </div>

      <div class="bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-xl transition">
        <i data-lucide="map-pin" class="w-12 h-12 text-indigo-600 mx-auto mb-4"></i>
        <h3 class="text-2xl font-bold mb-2">Yokohama</h3>
        <p class="text-gray-600 mb-4">
          <?php echo $translations['yokohama_desc'] ?? 'Rede completa em Yokohama, conectando você ao centro de Tokyo rapidamente.'; ?>
        </p>
        <div class="text-sm text-green-600 font-semibold">
          <?php echo $translations['disponivel'] ?? 'Disponível'; ?>
        </div>
      </div>

      <div class="bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-xl transition">
        <i data-lucide="map-pin" class="w-12 h-12 text-indigo-600 mx-auto mb-4"></i>
        <h3 class="text-2xl font-bold mb-2">Kyoto</h3>
        <p class="text-gray-600 mb-4">
          <?php echo $translations['kyoto_desc'] ?? 'Cobertura inicial em Kyoto, expandindo para atender a comunidade brasileira.'; ?>
        </p>
        <div class="text-sm text-yellow-600 font-semibold">
          <?php echo $translations['limitada'] ?? 'Limitada'; ?>
        </div>
      </div>

      <div class="bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-xl transition">
        <i data-lucide="map-pin" class="w-12 h-12 text-indigo-600 mx-auto mb-4"></i>
        <h3 class="text-2xl font-bold mb-2">
          <?php echo $translations['outras_cidades'] ?? 'Outras Cidades'; ?>
        </h3>
        <p class="text-gray-600 mb-4">
          <?php echo $translations['expansao_futura'] ?? 'Planejamos expansão para mais cidades. Entre em contato para atualizações.'; ?>
        </p>
        <div class="text-sm text-blue-600 font-semibold">
          <?php echo $translations['breve'] ?? 'Em Breve'; ?>
        </div>
      </div>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-lg text-center">
      <h2 class="text-3xl font-bold mb-6 text-indigo-700">
        <?php echo $translations['verificar_cobertura'] ?? 'Verifique sua Cobertura'; ?>
      </h2>
      <p class="text-gray-600 mb-8">
        <?php echo $translations['digite_endereco'] ?? 'Digite seu endereço completo para verificar se temos cobertura disponível.'; ?>
      </p>
      <form class="max-w-md mx-auto">
        <div class="mb-4">
          <input type="text" placeholder="<?php echo $translations['cep'] ?? 'CEP ou Endereço'; ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
        </div>
        <button type="submit" class="btn-cta">
          <?php echo $translations['verificar'] ?? 'Verificar'; ?>
        </button>
      </form>
    </div>
  </div>
</section>
