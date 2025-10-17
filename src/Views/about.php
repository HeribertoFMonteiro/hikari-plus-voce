<?php
// about.php - View for AboutController
?>

<section class="py-20 bg-gradient-to-br from-indigo-50 to-blue-50">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold mb-6 text-center text-indigo-700">
      <?php echo $translations['sobre'] ?? 'Sobre Nós'; ?>
    </h1>
    <div class="grid md:grid-cols-2 gap-12 items-center">
      <div>
        <h2 class="text-2xl font-semibold mb-4 text-indigo-600">
          <?php echo $translations['nossa_historia'] ?? 'Nossa História'; ?>
        </h2>
        <p class="text-gray-700 text-lg leading-relaxed mb-6">
          <?php echo $translations['historia_texto'] ?? 'Fundada em 2024, a Hikari + Você nasceu da necessidade de brasileiros e latinos residentes no Japão terem acesso a internet de qualidade com suporte no seu idioma. Entendemos os desafios da adaptação em um novo país e queremos facilitar sua conexão com o mundo digital.'; ?>
        </p>
        <h2 class="text-2xl font-semibold mb-4 text-indigo-600">
          <?php echo $translations['nossa_missao'] ?? 'Nossa Missão'; ?>
        </h2>
        <p class="text-gray-700 text-lg leading-relaxed mb-6">
          <?php echo $translations['missao_texto'] ?? 'Fornecer internet de alta velocidade com atendimento personalizado em português e espanhol, garantindo que famílias e profissionais latinos no Japão tenham a melhor experiência possível.'; ?>
        </p>
      </div>
      <div class="bg-white p-8 rounded-xl shadow-lg">
        <h3 class="text-xl font-semibold mb-6 text-center text-indigo-600">
          <?php echo $translations['por_que_escolher'] ?? 'Por Que Escolher a Hikari + Você?'; ?>
        </h3>
        <ul class="space-y-4">
          <li class="flex items-start">
            <i data-lucide="check-circle" class="w-6 h-6 text-green-500 mr-3 mt-1 flex-shrink-0"></i>
            <span><?php echo $translations['suporte_personalizado'] ?? 'Suporte personalizado em português e espanhol 24/7'; ?></span>
          </li>
          <li class="flex items-start">
            <i data-lucide="check-circle" class="w-6 h-6 text-green-500 mr-3 mt-1 flex-shrink-0"></i>
            <span><?php echo $translations['instalacao_gratis'] ?? 'Instalação gratuita e rápida'; ?></span>
          </li>
          <li class="flex items-start">
            <i data-lucide="check-circle" class="w-6 h-6 text-green-500 mr-3 mt-1 flex-shrink-0"></i>
            <span><?php echo $translations['fibra_qualidade'] ?? 'Fibra ótica de alta qualidade'; ?></span>
          </li>
          <li class="flex items-start">
            <i data-lucide="check-circle" class="w-6 h-6 text-green-500 mr-3 mt-1 flex-shrink-0"></i>
            <span><?php echo $translations['precos_competitivos'] ?? 'Preços competitivos para o mercado japonês'; ?></span>
          </li>
          <li class="flex items-start">
            <i data-lucide="check-circle" class="w-6 h-6 text-green-500 mr-3 mt-1 flex-shrink-0"></i>
            <span><?php echo $translations['atendimento_local'] ?? 'Atendimento local com compreensão cultural'; ?></span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="py-16 bg-white">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl font-bold mb-8 text-indigo-700">
      <?php echo $translations['equipe'] ?? 'Nossa Equipe'; ?>
    </h2>
    <p class="text-gray-600 mb-12">
      <?php echo $translations['equipe_desc'] ?? 'Profissionais dedicados a oferecer o melhor serviço para a comunidade latina no Japão.'; ?>
    </p>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="text-center">
        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face" alt="Foto de João Silva, Diretor Executivo da Hikari + Você" class="w-32 h-32 rounded-full mx-auto mb-4">
        <h3 class="text-xl font-semibold mb-2">João Silva</h3>
        <p class="text-gray-600">Diretor Executivo</p>
      </div>
      <div class="text-center">
        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop&crop=face" alt="Foto de Maria Garcia, Gerente de Suporte da Hikari + Você" class="w-32 h-32 rounded-full mx-auto mb-4">
        <h3 class="text-xl font-semibold mb-2">Maria Garcia</h3>
        <p class="text-gray-600">Gerente de Suporte</p>
      </div>
      <div class="text-center">
        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face" alt="Foto de Carlos Pereira, Especialista Técnico da Hikari + Você" class="w-32 h-32 rounded-full mx-auto mb-4">
        <h3 class="text-xl font-semibold mb-2">Carlos Pereira</h3>
        <p class="text-gray-600">Especialista Técnico</p>
      </div>
    </div>
  </div>
</section>
