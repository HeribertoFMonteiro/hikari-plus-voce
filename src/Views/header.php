<?php
// Cabeçalho HTML + abertura do body
// Definir idioma se não estiver definido
if (!isset($idioma)) {
    $idioma = isset($_GET['lang']) && $_GET['lang'] === 'es' ? 'es' : 'pt';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $idioma === 'es' ? 'es' : 'pt-br'; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo $translationsArr['meta_description'] ?? 'Internet de alta velocidade no Japão para brasileiros e latinos. Planos de fibra ótica com suporte em português e espanhol.'; ?>">
  <meta name="keywords" content="internet japão, fibra ótica, brasileiros japão, internet rápida tokyo, planos internet japão">
  <meta name="author" content="Hikari + Você">
  <meta property="og:title" content="Hikari + Você - Internet Rápida no Japão">
  <meta property="og:description" content="<?php echo $translationsArr['meta_description'] ?? 'Internet de alta velocidade no Japão para brasileiros e latinos.'; ?>">
  <meta property="og:image" content="/assets/images/og-image.jpg">
  <meta property="og:url" content="https://hikari-voce.com">
  <meta name="twitter:card" content="summary_large_image">
  <title><?php echo $translationsArr['titulo_pagina'] ?? 'Hikari + Você - Internet Rápida no Japão'; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="/assets/css/style.css" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <!-- Schema.org para SEO -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Hikari + Você",
    "url": "https://hikari-voce.com",
    "logo": "https://hikari-voce.com/assets/images/logo.png",
    "description": "<?php echo $translationsArr['meta_description'] ?? 'Internet de alta velocidade no Japão para brasileiros e latinos.'; ?>",
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+55-11-99999-9999",
      "contactType": "customer service",
      "availableLanguage": ["Portuguese", "Spanish"]
    }
  }
  </script>
</head>
<body class="bg-gray-50 text-gray-900">
<?php include __DIR__ . '/../../resources/partials/navbar.php'; ?>

<main class="pt-20">
