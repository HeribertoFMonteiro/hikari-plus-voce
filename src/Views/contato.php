<?php
// contato.php - View for ContatoController
?>

<section class="py-20 bg-gradient-to-br from-indigo-50 to-purple-50">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h1 class="text-4xl font-bold mb-6 text-indigo-700">
        <?php echo $translations['contato'] ?? 'Contato'; ?>
      </h1>
      <p class="text-gray-700 text-lg max-w-2xl mx-auto">
        <?php echo $translations['contato_desc'] ?? 'Entre em contato conosco para tirar dúvidas, solicitar instalação ou obter consultoria gratuita sobre nossos planos.'; ?>
      </p>
    </div>

    <div class="grid md:grid-cols-2 gap-12">
      <!-- Formulário de Contato -->
      <div class="bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-indigo-700">
          <?php echo $translations['envie_mensagem'] ?? 'Envie sua Mensagem'; ?>
        </h2>
        <?php echo $mensagem; ?>
        <form action="contato.php?lang=<?php echo $idioma; ?>" method="POST">
          <div class="mb-4">
            <label class="block mb-2 font-semibold">
              <?php echo $translations['nome'] ?? 'Nome'; ?> *
            </label>
            <input type="text" name="nome" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
          </div>
          <div class="mb-4">
            <label class="block mb-2 font-semibold">
              <?php echo $translations['email'] ?? 'Email'; ?> *
            </label>
            <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
          </div>
          <div class="mb-4">
            <label class="block mb-2 font-semibold">
              <?php echo $translations['telefone'] ?? 'Telefone'; ?>
            </label>
            <input type="tel" name="telefone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
          </div>
          <div class="mb-4">
            <label class="block mb-2 font-semibold">
              <?php echo $translations['plano_interesse'] ?? 'Plano de Interesse'; ?>
            </label>
            <select name="plano" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
              <option value=""><?php echo $translations['selecione_plano'] ?? 'Selecione um plano'; ?></option>
              <option value="basico"><?php echo $translations['plano_basico'] ?? 'Plano Básico'; ?></option>
              <option value="premium"><?php echo $translations['plano_intermediario'] ?? 'Plano Premium'; ?></option>
              <option value="ultra"><?php echo $translations['plano_avancado'] ?? 'Plano Ultra'; ?></option>
              <option value="consultoria"><?php echo $translations['consultoria'] ?? 'Consultoria'; ?></option>
            </select>
          </div>
          <div class="mb-6">
            <label class="block mb-2 font-semibold">
              <?php echo $translations['mensagem'] ?? 'Mensagem'; ?> *
            </label>
            <textarea name="mensagem" rows="5" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
          </div>
          <button type="submit" class="btn-cta w-full">
            <?php echo $translations['enviar'] ?? 'Enviar Mensagem'; ?>
          </button>
        </form>
      </div>

      <!-- Informações de Contato -->
      <div class="space-y-8">
        <div class="bg-white p-8 rounded-xl shadow-lg">
          <h3 class="text-2xl font-bold mb-6 text-indigo-700">
            <?php echo $translations['informacoes_contato'] ?? 'Informações de Contato'; ?>
          </h3>
          <div class="space-y-4">
            <div class="flex items-center">
              <i data-lucide="phone" class="w-6 h-6 text-indigo-600 mr-4"></i>
              <div>
                <div class="font-semibold"><?php echo $translations['telefone'] ?? 'Telefone'; ?></div>
                <div class="text-gray-600">+55 11 99999-9999</div>
              </div>
            </div>
            <div class="flex items-center">
              <i data-lucide="mail" class="w-6 h-6 text-indigo-600 mr-4"></i>
              <div>
                <div class="font-semibold"><?php echo $translations['email'] ?? 'Email'; ?></div>
                <div class="text-gray-600">contato@hikari-voce.com</div>
              </div>
            </div>
            <div class="flex items-center">
              <i data-lucide="message-circle" class="w-6 h-6 text-indigo-600 mr-4"></i>
              <div>
                <div class="font-semibold">WhatsApp</div>
                <div class="text-gray-600">+55 11 99999-9999</div>
              </div>
            </div>
            <div class="flex items-center">
              <i data-lucide="clock" class="w-6 h-6 text-indigo-600 mr-4"></i>
              <div>
                <div class="font-semibold"><?php echo $translations['horario'] ?? 'Horário de Atendimento'; ?></div>
                <div class="text-gray-600"><?php echo $translations['horario_desc'] ?? 'Segunda a Domingo, 24 horas'; ?></div>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-lg">
          <h3 class="text-2xl font-bold mb-6 text-indigo-700">
            <?php echo $translations['porque_contatar'] ?? 'Por Que nos Contatar?'; ?>
          </h3>
          <ul class="space-y-3">
            <li class="flex items-start">
              <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mr-3 mt-1"></i>
              <span><?php echo $translations['atendimento_pt_es'] ?? 'Atendimento em português e espanhol'; ?></span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mr-3 mt-1"></i>
              <span><?php echo $translations['consultoria_gratuita'] ?? 'Consultoria gratuita sobre planos'; ?></span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mr-3 mt-1"></i>
              <span><?php echo $translations['orcamento_personalizado'] ?? 'Orçamento personalizado'; ?></span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mr-3 mt-1"></i>
              <span><?php echo $translations['duvidas_respostas'] ?? 'Dúvidas respondidas rapidamente'; ?></span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
