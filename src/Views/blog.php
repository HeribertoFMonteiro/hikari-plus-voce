<?php
// blog.php - View for BlogController
?>

<section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h1 class="text-4xl font-bold mb-6 text-indigo-700">
        <?php echo $translations['blog'] ?? 'Blog'; ?>
      </h1>
      <p class="text-gray-700 text-lg max-w-2xl mx-auto">
        <?php echo $translations['blog_desc'] ?? 'Dicas, guias e informações sobre internet no Japão para brasileiros e latinos.'; ?>
      </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php foreach ($posts as $post): ?>
        <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
          <div class="p-6">
            <h2 class="text-xl font-bold mb-3 text-indigo-700 hover:text-indigo-600">
              <a href="post.php?slug=<?php echo $post['slug']; ?>&lang=<?php echo $idioma; ?>">
                <?php echo $post['titulo']; ?>
              </a>
            </h2>
            <p class="text-gray-600 mb-4 line-clamp-3">
              <?php echo substr(strip_tags($post['conteudo']), 0, 150) . '...'; ?>
            </p>
            <div class="flex items-center justify-between text-sm text-gray-500">
              <span><?php echo date('d/m/Y', strtotime($post['criado_em'])); ?></span>
              <a href="post.php?slug=<?php echo $post['slug']; ?>&lang=<?php echo $idioma; ?>" class="text-indigo-600 hover:text-indigo-700 font-medium">
                <?php echo $translations['ler_mais'] ?? 'Ler mais'; ?>
              </a>
            </div>
          </div>
        </article>
      <?php endforeach; ?>

      <?php if (empty($posts)): ?>
        <div class="col-span-full text-center py-12">
          <i data-lucide="file-text" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
          <h3 class="text-xl font-semibold text-gray-600 mb-2">
            <?php echo $translations['nenhum_post'] ?? 'Nenhum post encontrado'; ?>
          </h3>
          <p class="text-gray-500">
            <?php echo $translations['volta_em_breve'] ?? 'Volte em breve para mais conteúdos!'; ?>
          </p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
