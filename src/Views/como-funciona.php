<?php
// como-funciona.php - View for ComoFuncionaController
?>

<section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h1 class="text-4xl font-bold mb-6 text-indigo-700">
        <?php echo $translations['como_funciona'] ?? 'Como Funciona'; ?>
      </h1>
      <p class="text-gray-700 text-lg max-w-3xl mx-auto">
        <?php echo $translations['como_funciona_desc'] ?? 'Descubra o passo a passo para contratar e instalar sua internet de alta velocidade no Japão. Processo simples e transparente.'; ?>
      </p>
    </div>

    <div class="grid md:grid-cols-2 gap-12">
      <!-- Processo de Contratação -->
      <div class="bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-8 text-indigo-700 text-center">
          <?php echo $translations['processo_contratacao'] ?? 'Processo de Contratação'; ?>
        </h2>
        <div class="space-y-6">
          <div class="flex items-start">
            <div class="bg-indigo-100 p-3 rounded-full mr-4">
              <span class="text-indigo-600 font-bold text-xl">1</span>
            </div>
            <div>
              <h3 class="text-lg font-semibold mb-2">
                <?php echo $translations['passo1_titulo'] ?? 'Verificação de Disponibilidade'; ?>
              </h3>
              <p class="text-gray-600">
                <?php echo $translations['passo1_desc'] ?? 'Use nossa ferramenta online para verificar se a fibra ótica está disponível no seu endereço.'; ?>
              </p>
            </div>
          </div>

          <div class="flex items-start">
            <div class="bg-indigo-100 p-3 rounded-full mr-4">
              <span class="text-indigo-600 font-bold text-xl">2</span>
            </div>
            <div>
              <h3 class="text-lg font-semibold mb-2">
                <?php echo $translations['passo2_titulo'] ?? 'Escolha do Plano'; ?>
              </h3>
              <p class="text-gray-600">
                <?php echo $translations['passo2_desc'] ?? 'Compare nossos planos e selecione aquele que melhor atende suas necessidades.'; ?>
              </p>
            </div>
          </div>

          <div class="flex items-start">
            <div class="bg-indigo-100 p-3 rounded-full mr-4">
              <span class="text-indigo-600 font-bold text-xl">3</span>
            </div>
            <div>
              <h3 class="text-lg font-semibold mb-2">
                <?php echo $translations['passo3_titulo'] ?? 'Contato e Agendamento'; ?>
              </h3>
              <p class="text-gray-600">
                <?php echo $translations['passo3_desc'] ?? 'Entre em contato conosco para agendar a instalação na data que preferir.'; ?>
              </p>
            </div>
          </div>

          <div class="flex items-start">
            <div class="bg-indigo-100 p-3 rounded-full mr-4">
              <span class="text-indigo-600 font-bold text-xl">4</span>
            </div>
            <div>
              <h3 class="text-lg font-semibold mb-2">
                <?php echo $translations['passo4_titulo'] ?? 'Instalação e Ativação'; ?>
              </h3>
              <p class="text-gray-600">
                <?php echo $translations['passo4_desc'] ?? 'Nossa equipe realiza a instalação profissionalmente e ativa seu serviço.'; ?>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Requisitos e Documentação -->
      <div class="bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-8 text-indigo-700 text-center">
          <?php echo $translations['requisitos'] ?? 'Requisitos e Documentação'; ?>
        </h2>
        <div class="space-y-6">
          <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="font-semibold mb-2 flex items-center">
              <i data-lucide="file-text" class="w-5 h-5 mr-2 text-indigo-600"></i>
              <?php echo $translations['documentos_necessarios'] ?? 'Documentos Necessários'; ?>
            </h3>
            <ul class="text-sm text-gray-600 space-y-1 ml-7">
              <li>• <?php echo $translations['doc1'] ?? 'Passaporte ou visto de residência válido'; ?></li>
              <li>• <?php echo $translations['doc2'] ?? 'Comprovante de endereço no Japão'; ?></li>
              <li>• <?php echo $translations['doc3'] ?? 'Dados para cobrança (cartão ou conta bancária)'; ?></li>
            </ul>
          </div>

          <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="font-semibold mb-2 flex items-center">
              <i data-lucide="home" class="w-5 h-5 mr-2 text-indigo-600"></i>
              <?php echo $translations['instalacao'] ?? 'Sobre a Instalação'; ?>
            </h3>
            <ul class="text-sm text-gray-600 space-y-1 ml-7">
              <li>• <?php echo $translations['inst1'] ?? 'Instalação gratuita para a maioria dos planos'; ?></li>
              <li>• <?php echo $translations['inst2'] ?? 'Agendamento flexível de segunda a sábado'; ?></li>
              <li>• <?php echo $translations['inst3'] ?? 'Duração aproximada: 2-3 horas'; ?></li>
              <li>• <?php echo $translations['inst4'] ?? 'Roteador Wi-Fi incluso no plano'; ?></li>
            </ul>
          </div>

          <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="font-semibold mb-2 flex items-center">
              <i data-lucide="clock" class="w-5 h-5 mr-2 text-indigo-600"></i>
              <?php echo $translations['prazos'] ?? 'Prazos e Tempos'; ?>
            </h3>
            <ul class="text-sm text-gray-600 space-y-1 ml-7">
              <li>• <?php echo $translations['prazo1'] ?? 'Verificação de disponibilidade: Imediata'; ?></li>
              <li>• <?php echo $translations['prazo2'] ?? 'Agendamento de instalação: 1-3 dias úteis'; ?></li>
              <li>• <?php echo $translations['prazo3'] ?? 'Ativação do serviço: Mesmo dia da instalação'; ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA -->
    <div class="text-center mt-16">
      <div class="bg-indigo-600 text-white p-8 rounded-xl">
        <h2 class="text-2xl font-bold mb-4">
          <?php echo $translations['pronto_contratar'] ?? 'Pronto para Contratar?'; ?>
        </h2>
        <p class="mb-6">
          <?php echo $translations['contato_agora'] ?? 'Entre em contato conosco agora e tenha internet de alta velocidade em casa!'; ?>
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="planos.php?lang=<?php echo $idioma; ?>" class="bg-white text-indigo-600 font-semibold py-3 px-6 rounded-lg hover:bg-gray-100 transition">
            <?php echo $translations['ver_planos'] ?? 'Ver Planos'; ?>
          </a>
          <a href="contato.php?lang=<?php echo $idioma; ?>" class="bg-orange-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-orange-600 transition">
            <?php echo $translations['falar_consultor'] ?? 'Falar com Consultor'; ?>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
