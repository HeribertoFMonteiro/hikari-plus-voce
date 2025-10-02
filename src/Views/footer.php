<?php
$idioma = isset($_GET['lang']) && $_GET['lang'] === 'es' ? 'es' : 'pt';

// Conectar ao banco
require_once __DIR__ . '/../Models/Database.php';

// Buscar traduções
$translationsArr = [];
try {
  $db = Database::getInstance();
  $translationsArr = $db->getTranslations($idioma);
} catch (Exception $e) {
  // Valores padrão se erro
  $translationsArr = [];
}
?>

<footer class="bg-gray-900 text-white py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid md:grid-cols-4 gap-8">
      <!-- Logo e descrição -->
      <div class="md:col-span-1">
        <div class="flex items-center mb-4">
          <svg class="w-8 h-8 mr-2 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
          </svg>
          <span class="text-xl font-bold">Hikari + Você</span>
        </div>
        <p class="text-gray-400 text-sm">
          <?php echo $translationsArr['footer_desc'] ?? 'Internet de alta velocidade no Japão com suporte em português e espanhol.'; ?>
        </p>
      </div>

      <!-- Links rápidos -->
      <div>
        <h3 class="text-lg font-semibold mb-4"><?php echo $translationsArr['links_rapidos'] ?? 'Links Rápidos'; ?></h3>
        <ul class="space-y-2">
          <li><a href="index.php?lang=<?php echo $idioma; ?>" class="text-gray-400 hover:text-white transition"><?php echo $translationsArr['inicio'] ?? 'Início'; ?></a></li>
          <li><a href="planos.php?lang=<?php echo $idioma; ?>" class="text-gray-400 hover:text-white transition"><?php echo $translationsArr['planos'] ?? 'Planos'; ?></a></li>
          <li><a href="cobertura.php?lang=<?php echo $idioma; ?>" class="text-gray-400 hover:text-white transition"><?php echo $translationsArr['cobertura'] ?? 'Cobertura'; ?></a></li>
          <li><a href="contato.php?lang=<?php echo $idioma; ?>" class="text-gray-400 hover:text-white transition"><?php echo $translationsArr['contato'] ?? 'Contato'; ?></a></li>
        </ul>
      </div>

      <!-- Suporte -->
      <div>
        <h3 class="text-lg font-semibold mb-4"><?php echo $translationsArr['suporte'] ?? 'Suporte'; ?></h3>
        <ul class="space-y-2">
          <li><a href="blog.php?lang=<?php echo $idioma; ?>" class="text-gray-400 hover:text-white transition">Blog</a></li>
          <li><a href="como-funciona.php?lang=<?php echo $idioma; ?>" class="text-gray-400 hover:text-white transition"><?php echo $translationsArr['como_funciona'] ?? 'Como Funciona'; ?></a></li>
          <li><a href="faq.php?lang=<?php echo $idioma; ?>" class="text-gray-400 hover:text-white transition">FAQ</a></li>
          <li><a href="contato.php?lang=<?php echo $idioma; ?>" class="text-gray-400 hover:text-white transition"><?php echo $translationsArr['ajuda'] ?? 'Ajuda'; ?></a></li>
        </ul>
      </div>

      <!-- Contato -->
      <div>
        <h3 class="text-lg font-semibold mb-4"><?php echo $translationsArr['contato'] ?? 'Contato'; ?></h3>
        <div class="space-y-2">
          <a href="https://wa.me/5511999999999" class="flex items-center text-gray-400 hover:text-white transition">
            <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
            WhatsApp: +55 11 99999-9999
          </a>
          <a href="mailto:contato@hikari-voce.com" class="flex items-center text-gray-400 hover:text-white transition">
            <i data-lucide="mail" class="w-5 h-5 mr-2"></i>
            contato@hikari-voce.com
          </a>
        </div>
        <!-- Redes sociais -->
        <div class="flex space-x-4 mt-4">
          <a href="#" class="text-gray-400 hover:text-white transition">
            <i data-lucide="instagram" class="w-6 h-6"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white transition">
            <i data-lucide="facebook" class="w-6 h-6"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white transition">
            <i data-lucide="twitter" class="w-6 h-6"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Selo SSL e direitos -->
    <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
      <p class="text-gray-400 text-sm">&copy; <?php echo date('Y'); ?> Hikari + Você. <?php echo $translationsArr['todos_direitos'] ?? 'Todos os direitos reservados.'; ?></p>
      <div class="flex items-center space-x-4 mt-4 md:mt-0">
        <div class="flex items-center text-gray-400 text-sm">
          <i data-lucide="shield" class="w-5 h-5 mr-2 text-green-400"></i>
          SSL Seguro
        </div>
        <div class="text-gray-400 text-sm">
          <?php echo $translationsArr['privacidade'] ?? 'Política de Privacidade'; ?> | <?php echo $translationsArr['termos'] ?? 'Termos de Uso'; ?>
        </div>
      </div>
    </div>
  </div>
</footer>

<script>
  // Inicializar ícones Lucide
  lucide.createIcons();
</script>

</main>
</body>
</html>
