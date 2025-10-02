<?php
// Ativar exibição de erros para debug (opcional)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Definir idioma
$idioma = isset($_GET['lang']) && $_GET['lang'] === 'es' ? 'es' : 'pt';

// Função para gerar link com idioma
if (!function_exists('generateLink')) {
    function generateLink($arquivo, $idioma) {
        return $arquivo . '?lang=' . $idioma;
    }
}

// Conectar ao banco de dados para traduções
$translationsArr = [];
try {
    require_once __DIR__ . '/../../src/Models/Database.php';
    $db = Database::getInstance();
    $translationsArr = $db->getTranslations($idioma);
} catch (Exception $e) {
    // Valores padrão se erro
    $translationsArr = [];
}

?>

<header class="fixed w-full z-50 bg-white/95 backdrop-blur-md shadow-lg">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      
      <!-- Logo -->
      <div class="flex-shrink-0">
        <a href="<?php echo generateLink('index.php', $idioma); ?>" class="text-2xl font-bold text-indigo-600 flex items-center">
          <svg class="w-8 h-8 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
          </svg>
          Hikari + Você
        </a>
      </div>

      <!-- Menu principal -->
      <nav class="hidden md:flex space-x-8">
        <a href="<?php echo generateLink('planos.php', $idioma); ?>" class="text-gray-700 hover:text-indigo-600 font-medium transition">
          <?php echo $translationsArr['planos'] ?? 'Planos'; ?>
        </a>
        <a href="<?php echo generateLink('cobertura.php', $idioma); ?>" class="text-gray-700 hover:text-indigo-600 font-medium transition">
          <?php echo $translationsArr['cobertura'] ?? 'Cobertura'; ?>
        </a>
        <a href="<?php echo generateLink('como-funciona.php', $idioma); ?>" class="text-gray-700 hover:text-indigo-600 font-medium transition">
          <?php echo $translationsArr['como_funciona'] ?? 'Como Funciona'; ?>
        </a>
        <a href="<?php echo generateLink('faq.php', $idioma); ?>" class="text-gray-700 hover:text-indigo-600 font-medium transition">
          FAQ
        </a>
        <a href="<?php echo generateLink('contato.php', $idioma); ?>" class="text-gray-700 hover:text-indigo-600 font-medium transition">
          <?php echo $translationsArr['contato'] ?? 'Contato'; ?>
        </a>
      </nav>

      <!-- Seletor de idioma e CTA -->
      <div class="flex items-center space-x-4">
        <div class="flex space-x-1">
          <a href="?lang=pt" class="px-3 py-1 text-sm font-medium rounded-md <?php echo $idioma==='pt' ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100'; ?> transition">
            PT
          </a>
          <a href="?lang=es" class="px-3 py-1 text-sm font-medium rounded-md <?php echo $idioma==='es' ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100'; ?> transition">
            ES
          </a>
        </div>
        <a href="<?php echo generateLink('contato.php', $idioma); ?>" class="btn-cta hidden md:inline-block">
          Solicitar Internet
        </a>
      </div>

    </div>
  </div>
</header>
