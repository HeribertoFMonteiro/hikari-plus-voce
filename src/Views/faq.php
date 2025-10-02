<?php
// faq.php - View for FaqController
?>

<section class="py-20 bg-gradient-to-br from-green-50 to-blue-50">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h1 class="text-4xl font-bold mb-6 text-indigo-700">
        FAQ - <?php echo $translations['perguntas_frequentes'] ?? 'Perguntas Frequentes'; ?>
      </h1>
      <p class="text-gray-700 text-lg">
        <?php echo $translations['faq_desc'] ?? 'Encontre respostas para as dúvidas mais comuns sobre nossos serviços de internet.'; ?>
      </p>
    </div>

    <div class="space-y-4">
      <!-- Pergunta 1 -->
      <div class="bg-white rounded-lg shadow-md">
        <button class="w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg faq-question">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">
              <?php echo $translations['pergunta1'] ?? 'Quais são os planos disponíveis?'; ?>
            </h3>
            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transform transition-transform faq-icon"></i>
          </div>
        </button>
        <div class="px-6 pb-4 faq-answer hidden">
          <p class="text-gray-700 mt-2">
            <?php echo $translations['resposta1'] ?? 'Oferecemos três planos principais: Básico (100 Mbps), Premium (300 Mbps) e Ultra (1 Gbps). Todos incluem roteador Wi-Fi, instalação gratuita e suporte 24/7.'; ?>
          </p>
        </div>
      </div>

      <!-- Pergunta 2 -->
      <div class="bg-white rounded-lg shadow-md">
        <button class="w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg faq-question">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">
              <?php echo $translations['pergunta2'] ?? 'Como verificar se tenho cobertura?'; ?>
            </h3>
            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transform transition-transform faq-icon"></i>
          </div>
        </button>
        <div class="px-6 pb-4 faq-answer hidden">
          <p class="text-gray-700 mt-2">
            <?php echo $translations['resposta2'] ?? 'Use nossa ferramenta de verificação de cobertura na página inicial ou entre em contato conosco. Informe seu endereço completo e verificaremos a disponibilidade.'; ?>
          </p>
        </div>
      </div>

      <!-- Pergunta 3 -->
      <div class="bg-white rounded-lg shadow-md">
        <button class="w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg faq-question">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">
              <?php echo $translations['pergunta3'] ?? 'Qual é o prazo de instalação?'; ?>
            </h3>
            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transform transition-transform faq-icon"></i>
          </div>
        </button>
        <div class="px-6 pb-4 faq-answer hidden">
          <p class="text-gray-700 mt-2">
            <?php echo $translations['resposta3'] ?? 'O prazo médio é de 1-3 dias úteis após a contratação. Trabalhamos de segunda a sábado para atender suas necessidades.'; ?>
          </p>
        </div>
      </div>

      <!-- Pergunta 4 -->
      <div class="bg-white rounded-lg shadow-md">
        <button class="w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg faq-question">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">
              <?php echo $translations['pergunta4'] ?? 'Oferecem suporte em português?'; ?>
            </h3>
            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transform transition-transform faq-icon"></i>
          </div>
        </button>
        <div class="px-6 pb-4 faq-answer hidden">
          <p class="text-gray-700 mt-2">
            <?php echo $translations['resposta4'] ?? 'Sim! Temos suporte completo em português e espanhol, 24 horas por dia, 7 dias por semana, com atendentes que entendem nossa cultura.'; ?>
          </p>
        </div>
      </div>

      <!-- Pergunta 5 -->
      <div class="bg-white rounded-lg shadow-md">
        <button class="w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg faq-question">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">
              <?php echo $translations['pergunta5'] ?? 'Posso cancelar a qualquer momento?'; ?>
            </h3>
            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transform transition-transform faq-icon"></i>
          </div>
        </button>
        <div class="px-6 pb-4 faq-answer hidden">
          <p class="text-gray-700 mt-2">
            <?php echo $translations['resposta5'] ?? 'Sim, não há multa por cancelamento. Basta entrar em contato conosco com 30 dias de antecedência. Ajudaremos com todo o processo.'; ?>
          </p>
        </div>
      </div>

      <!-- Pergunta 6 -->
      <div class="bg-white rounded-lg shadow-md">
        <button class="w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg faq-question">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">
              <?php echo $translations['pergunta6'] ?? 'Quais documentos preciso para contratar?'; ?>
            </h3>
            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transform transition-transform faq-icon"></i>
          </div>
        </button>
        <div class="px-6 pb-4 faq-answer hidden">
          <p class="text-gray-700 mt-2">
            <?php echo $translations['resposta6'] ?? 'Você precisa de: passaporte ou visto válido, comprovante de endereço no Japão e dados para cobrança (cartão de crédito ou conta bancária).'; ?>
          </p>
        </div>
      </div>

      <!-- Pergunta 7 -->
      <div class="bg-white rounded-lg shadow-md">
        <button class="w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg faq-question">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">
              <?php echo $translations['pergunta7'] ?? 'A instalação é gratuita?'; ?>
            </h3>
            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transform transition-transform faq-icon"></i>
          </div>
        </button>
        <div class="px-6 pb-4 faq-answer hidden">
          <p class="text-gray-700 mt-2">
            <?php echo $translations['resposta7'] ?? 'Sim, a instalação é gratuita para a maioria dos planos. Apenas em casos especiais pode haver taxa adicional, que será informada previamente.'; ?>
          </p>
        </div>
      </div>

      <!-- Pergunta 8 -->
      <div class="bg-white rounded-lg shadow-md">
        <button class="w-full px-6 py-4 text-left focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg faq-question">
          <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">
              <?php echo $translations['pergunta8'] ?? 'Como funciona o suporte técnico?'; ?>
            </h3>
            <i data-lucide="chevron-down" class="w-5 h-5 text-gray-500 transform transition-transform faq-icon"></i>
          </div>
        </button>
        <div class="px-6 pb-4 faq-answer hidden">
          <p class="text-gray-700 mt-2">
            <?php echo $translations['resposta8'] ?? 'Oferecemos suporte 24/7 por telefone, WhatsApp, chat online e email. Atendemos em português e espanhol, resolvendo problemas técnicos rapidamente.'; ?>
          </p>
        </div>
      </div>
    </div>

    <!-- CTA -->
    <div class="text-center mt-12">
      <div class="bg-indigo-600 text-white p-8 rounded-xl">
        <h2 class="text-2xl font-bold mb-4">
          <?php echo $translations['nao_encontrou_resposta'] ?? 'Não encontrou sua resposta?'; ?>
        </h2>
        <p class="mb-6">
          <?php echo $translations['contate_nos'] ?? 'Nossa equipe está pronta para ajudar com qualquer dúvida!'; ?>
        </p>
        <a href="contato.php?lang=<?php echo $idioma; ?>" class="bg-orange-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-orange-600 transition">
          <?php echo $translations['falar_conosco'] ?? 'Falar Conosco'; ?>
        </a>
      </div>
    </div>
  </div>
</section>

<script>
// FAQ Accordion
document.addEventListener('DOMContentLoaded', function() {
  const faqQuestions = document.querySelectorAll('.faq-question');

  faqQuestions.forEach(question => {
    question.addEventListener('click', function() {
      const answer = this.nextElementSibling;
      const icon = this.querySelector('.faq-icon');

      if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
      } else {
        answer.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
      }
    });
  });
});
</script>
