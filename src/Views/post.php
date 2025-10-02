<?php
// post.php - View for PostController
?>

<section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-50">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <article class="bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="p-8 lg:p-12">
        <header class="mb-8">
          <h1 class="text-3xl lg:text-4xl font-bold mb-4 text-indigo-700">
            <?php echo $post['titulo']; ?>
          </h1>
          <div class="flex items-center text-gray-500 text-sm">
            <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
            <span><?php echo date('d/m/Y', strtotime($post['criado_em'])); ?></span>
          </div>
        </header>

        <div class="prose prose-lg max-w-none">
          <?php echo $post['conteudo']; ?>
        </div>
      </div>
    </article>

    <div class="mt-8 text-center">
      <a href="blog.php?lang=<?php echo $idioma; ?>" class="btn-cta">
        <?php echo $translations['voltar_blog'] ?? 'Voltar ao Blog'; ?>
      </a>
    </div>
  </div>
</section>
