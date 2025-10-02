<?php
/**
 * layout.php
 * Template base para as páginas
 */

// Definir idioma
$idioma = isset($_GET['lang']) && $_GET['lang'] === 'es' ? 'es' : 'pt';

// Buscar traduções
require '../src/Models/Database.php';
$db = Database::getInstance();
$translationsArr = $db->getTranslations($idioma);
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma === 'es' ? 'es' : 'pt-br'; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo $translationsArr['meta_description'] ?? 'Internet de alta velocidade no Japão para brasileiros e latinos.'; ?>">
  <meta name="keywords" content="internet japão, fibra ótica, brasileiros japão">
  <title><?php echo $translationsArr['titulo_pagina'] ?? 'Hikari + Você'; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="/assets/css/style.css" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="bg-gray-50 text-gray-900">

<?php include '../resources/partials/navbar.php'; ?>

<main class="pt-20">
  <?php echo $content; // Conteúdo específico da página ?>
</main>

<?php include '../src/Views/footer.php'; ?>

<script>
  lucide.createIcons();
</script>
</body>
</html>
