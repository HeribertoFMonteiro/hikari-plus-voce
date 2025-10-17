<?php
// home.php - View for HomeController
?>

<!-- Seção Hero -->
<section class="hero py-32 text-center relative overflow-hidden">
  <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-blue-800 to-green-600 opacity-90"></div>
  <div class="absolute inset-0 bg-black opacity-30"></div>
  <!-- Background image placeholder -->
  <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=1200');"></div>
  <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 id="hero-title" class="text-5xl md:text-6xl font-bold mb-6 text-black opacity-0 transform translate-y-8">
      <?php echo $translations['titulo_hero'] ?? 'Internet rápida no Japão para brasileiros e latinos'; ?>
    </h1>
    <p id="hero-subtitle" class="text-xl md:text-2xl font-semibold mb-8 text-gray-800 opacity-0 transform translate-y-8 tracking-wide leading-relaxed">
      <?php echo $translations['subtitulo_hero'] ?? 'Planos de fibra ótica com suporte em Português e Espanhol'; ?>
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="planos.php?lang=<?php echo $idioma; ?>" class="btn-cta text-lg px-8 py-4">
        <?php echo $translations['ver_planos'] ?? 'Ver Planos'; ?>
      </a>
      <a href="cobertura.php?lang=<?php echo $idioma; ?>" class="bg-white text-indigo-600 font-semibold py-4 px-8 rounded-lg hover:bg-gray-100 transition text-lg">
        <?php echo $translations['verificar_cobertura'] ?? 'Verificar Cobertura'; ?>
      </a>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const title = document.getElementById('hero-title');
  const subtitle = document.getElementById('hero-subtitle');

  // Animação sequencial elegante
  setTimeout(() => {
    // Animação simples do título
    title.style.transition = 'all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
    title.style.opacity = '1';
    title.style.transform = 'translateY(0)';

    // Adicionar efeito de brilho no título
    title.style.textShadow = '0 0 20px rgba(255, 255, 255, 0.8), 0 0 40px rgba(255, 255, 255, 0.6)';

    // Efeito de pisca-pisca no título (mais rápido que o subtítulo)
    setTimeout(() => {
      title.style.animation = 'headlight-blink 2s ease-in-out infinite';
    }, 800);

    // Animação do subtítulo com delay
    setTimeout(() => {
      subtitle.style.transition = 'all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
      subtitle.style.opacity = '1';
      subtitle.style.transform = 'translateY(0)';

      // Efeito de brilho intenso inicial no subtítulo
      subtitle.style.textShadow = '0 0 15px rgba(255, 255, 255, 0.9), 0 0 30px rgba(255, 255, 255, 0.7), 0 0 45px rgba(255, 255, 255, 0.5)';

      // Efeito de pisca-pisca lento como farol de carro (muda apenas sombras e opacidade)
      setTimeout(() => {
        subtitle.style.animation = 'headlight-blink 3s ease-in-out infinite';
        // Manter a cor original do texto
        subtitle.style.color = '';
      }, 1200);
    }, 600);

    // Efeito de partículas flutuantes (opcional visual enhancement)
    createFloatingParticles();

  }, 300);
});

// Função para criar partículas flutuantes
function createFloatingParticles() {
  const heroSection = document.querySelector('.hero');
  const particleCount = 15;

  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement('div');
    particle.className = 'floating-particle';
    particle.style.cssText = `
      position: absolute;
      width: 4px;
      height: 4px;
      background: rgba(255, 255, 255, 0.6);
      border-radius: 50%;
      pointer-events: none;
      animation: float-particle ${3 + Math.random() * 4}s ease-in-out infinite;
      animation-delay: ${Math.random() * 3}s;
      left: ${Math.random() * 100}%;
      top: ${Math.random() * 100}%;
      box-shadow: 0 0 6px rgba(255, 255, 255, 0.8);
    `;
    heroSection.appendChild(particle);

    // Remover partículas após a animação
    setTimeout(() => {
      if (particle.parentNode) {
        particle.parentNode.removeChild(particle);
      }
    }, 8000);
  }
}

// Adicionar estilos CSS para as animações
const style = document.createElement('style');
style.textContent = `
  @keyframes float-particle {
    0%, 100% {
      transform: translateY(0px) rotate(0deg);
      opacity: 0.6;
    }
    50% {
      transform: translateY(-20px) rotate(180deg);
      opacity: 1;
    }
  }

  @keyframes pulse-glow {
    0%, 100% {
      text-shadow: 0 0 10px rgba(255, 255, 255, 0.3), 0 0 20px rgba(255, 255, 255, 0.2);
    }
    50% {
      text-shadow: 0 0 20px rgba(255, 255, 255, 0.6), 0 0 40px rgba(255, 255, 255, 0.4), 0 0 60px rgba(255, 255, 255, 0.2);
    }
  }

  @keyframes pulse-glow-strong {
    0%, 100% {
      text-shadow: 0 0 15px rgba(255, 255, 255, 0.9), 0 0 30px rgba(255, 255, 255, 0.7), 0 0 45px rgba(255, 255, 255, 0.5);
    }
    50% {
      text-shadow: 0 0 25px rgba(255, 255, 255, 1), 0 0 50px rgba(255, 255, 255, 0.8), 0 0 75px rgba(255, 255, 255, 0.6), 0 0 100px rgba(255, 255, 255, 0.4);
    }
  }

  @keyframes headlight-blink {
    0%, 100% {
      text-shadow:
        0 0 10px rgba(255, 255, 255, 1),
        0 0 20px rgba(255, 255, 255, 0.9),
        0 0 30px rgba(255, 255, 255, 0.8),
        0 0 40px rgba(255, 255, 255, 0.7);
      opacity: 1;
    }
    50% {
      text-shadow:
        0 0 3px rgba(255, 255, 255, 0.4),
        0 0 6px rgba(255, 255, 255, 0.3),
        0 0 9px rgba(255, 255, 255, 0.2);
      opacity: 0.8;
    }
  }

  .floating-particle {
    will-change: transform, opacity;
  }
`;
document.head.appendChild(style);
</script>

<!-- Seção Planos -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-center mb-12">
      <?php echo $translations['planos_titulo'] ?? 'Nossos Planos de Internet'; ?>
    </h2>
    <div class="grid md:grid-cols-3 gap-8">
      <?php foreach ($planosDestaque as $plano): ?>
        <?php
          $destaqueClass = $plano['destaque'] ? 'border-2 border-indigo-600 relative' : '';
          $beneficios = explode(';', $plano['beneficios']);
        ?>
        <div class="plan-card p-8 text-center <?php echo $destaqueClass; ?>">
          <?php if ($plano['destaque']): ?>
            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-indigo-600 text-white px-4 py-1 rounded-full text-sm font-semibold">
              <?php echo $translations['mais_popular'] ?? 'Mais Popular'; ?>
            </div>
          <?php endif; ?>
          <div class="mb-4">
            <i data-lucide="<?php echo $plano['icone'] ?? 'wifi'; ?>" class="w-12 h-12 text-indigo-600 mx-auto"></i>
          </div>
          <h3 class="text-2xl font-bold mb-4">
            <?php echo $plano['nome']; ?>
          </h3>
          <p class="text-4xl font-bold text-indigo-600 mb-2">¥<?php echo number_format($plano['preco'], 0, ',', '.'); ?><span class="text-lg font-normal">/mês</span></p>
          <p class="text-gray-600 mb-6">
            <?php echo $plano['descricao']; ?>
          </p>
          <ul class="text-left mb-6 space-y-2">
            <li>🚀 Velocidade: <?php echo $plano['velocidade']; ?></li>
            <?php foreach ($beneficios as $beneficio): ?>
              <li class="flex items-center"><i data-lucide="check" class="w-5 h-5 text-green-500 mr-2"></i><?php echo trim($beneficio); ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="contato.php?lang=<?php echo $idioma; ?>" class="btn-cta w-full block text-center">
            <?php echo $translations['solicitar_agora'] ?? 'Solicitar Agora'; ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Calculadora de Disponibilidade -->
<section class="py-16 bg-gray-50">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl font-bold mb-8">
      <?php echo $translations['calculadora_titulo'] ?? 'Verifique a Disponibilidade'; ?>
    </h2>
    <p class="text-gray-600 mb-8">
      <?php echo $translations['calculadora_desc'] ?? 'Digite seu endereço e descubra quais planos estão disponíveis na sua região.'; ?>
    </p>
    <form class="bg-white p-8 rounded-xl shadow-lg">
      <div class="grid md:grid-cols-2 gap-6 mb-6">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">
            <?php echo $translations['cep'] ?? 'CEP ou Endereço'; ?>
          </label>
          <input type="text" placeholder="Ex: 123-4567 Tokyo" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">
            <?php echo $translations['cidade'] ?? 'Cidade'; ?>
          </label>
          <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            <option><?php echo $translations['selecione_cidade'] ?? 'Selecione a cidade'; ?></option>
            <option>Tokyo</option>
            <option>Osaka</option>
            <option>Yokohama</option>
            <option>Nagoya</option>
          </select>
        </div>
      </div>
      <button type="submit" class="btn-cta">
        <?php echo $translations['verificar_disponibilidade'] ?? 'Verificar Disponibilidade'; ?>
      </button>
    </form>
  </div>
</section>

<!-- Comparativo de Provedores -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-center mb-12">
      <?php echo $translations['comparativo_titulo'] ?? 'Compare Provedores'; ?>
    </h2>
    <div class="overflow-x-auto">
      <table class="w-full bg-white shadow-lg rounded-lg">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Recursos</th>
            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Hikari + Você</th>
            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">NURO</th>
            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">FLET'S</th>
            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">SoftBank</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <tr>
            <td class="px-6 py-4 text-sm text-gray-900 font-medium">Suporte em Português</td>
            <td class="px-6 py-4 text-center"><i data-lucide="check" class="w-5 h-5 text-green-500 mx-auto"></i></td>
            <td class="px-6 py-4 text-center"><i data-lucide="x" class="w-5 h-5 text-red-500 mx-auto"></i></td>
            <td class="px-6 py-4 text-center"><i data-lucide="x" class="w-5 h-5 text-red-500 mx-auto"></i></td>
            <td class="px-6 py-4 text-center"><i data-lucide="x" class="w-5 h-5 text-red-500 mx-auto"></i></td>
          </tr>
          <tr class="bg-gray-50">
            <td class="px-6 py-4 text-sm text-gray-900 font-medium">Instalação Gratuita</td>
            <td class="px-6 py-4 text-center"><i data-lucide="check" class="w-5 h-5 text-green-500 mx-auto"></i></td>
            <td class="px-6 py-4 text-center"><i data-lucide="check" class="w-5 h-5 text-green-500 mx-auto"></i></td>
            <td class="px-6 py-4 text-center"><i data-lucide="x" class="w-5 h-5 text-red-500 mx-auto"></i></td>
            <td class="px-6 py-4 text-center"><i data-lucide="x" class="w-5 h-5 text-red-500 mx-auto"></i></td>
          </tr>
          <tr>
            <td class="px-6 py-4 text-sm text-gray-900 font-medium">Roteador Incluso</td>
            <td class="px-6 py-4 text-center"><i data-lucide="check" class="w-5 h-5 text-green-500 mx-auto"></i></td>
            <td class="px-6 py-4 text-center"><i data-lucide="check" class="w-5 h-5 text-green-500 mx-auto"></i></td>
            <td class="px-6 py-4 text-center"><i data-lucide="check" class="w-5 h-5 text-green-500 mx-auto"></i></td>
            <td class="px-6 py-4 text-center"><i data-lucide="check" class="w-5 h-5 text-green-500 mx-auto"></i></td>
          </tr>
          <tr class="bg-gray-50">
            <td class="px-6 py-4 text-sm text-gray-900 font-medium">Atendimento 24/7</td>
            <td class="px-6 py-4 text-center"><i data-lucide="check" class="w-5 h-5 text-green-500 mx-auto"></i></td>
            <td class="px-6 py-4 text-center"><i data-lucide="x" class="w-5 h-5 text-red-500 mx-auto"></i></td>
            <td class="px-6 py-4 text-center"><i data-lucide="check" class="w-5 h-5 text-green-500 mx-auto"></i></td>
            <td class="px-6 py-4 text-center"><i data-lucide="check" class="w-5 h-5 text-green-500 mx-auto"></i></td>
          </tr>
          <tr>
            <td class="px-6 py-4 text-sm text-gray-900 font-medium">Preço Médio (300Mbps)</td>
            <td class="px-6 py-4 text-center text-indigo-600 font-semibold">¥4,500</td>
            <td class="px-6 py-4 text-center">¥5,200</td>
            <td class="px-6 py-4 text-center">¥4,800</td>
            <td class="px-6 py-4 text-center">¥5,500</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="text-center mt-8">
      <a href="contato.php?lang=<?php echo $idioma; ?>" class="btn-cta">
        <?php echo $translations['consultoria_gratuita'] ?? 'Agendar Consultoria Gratuita'; ?>
      </a>
    </div>
  </div>
</section>

<!-- Guia Rápido -->
<section id="como-funciona" class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-center mb-12">
      <?php echo $translations['guia_titulo'] ?? 'Como Contratar Internet no Japão'; ?>
    </h2>
    <div class="grid md:grid-cols-2 gap-8">
      <div class="bg-white p-8 rounded-xl shadow-lg">
        <div class="flex items-start mb-6">
          <div class="bg-indigo-100 p-3 rounded-lg mr-4">
            <i data-lucide="search" class="w-6 h-6 text-indigo-600"></i>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">
              <?php echo $translations['passo1_titulo'] ?? '1. Verifique a Disponibilidade'; ?>
            </h3>
            <p class="text-gray-600">
              <?php echo $translations['passo1_desc'] ?? 'Use nossa calculadora para confirmar se a fibra ótica está disponível no seu endereço.'; ?>
            </p>
          </div>
        </div>
      </div>
      <div class="bg-white p-8 rounded-xl shadow-lg">
        <div class="flex items-start mb-6">
          <div class="bg-indigo-100 p-3 rounded-lg mr-4">
            <i data-lucide="clipboard-list" class="w-6 h-6 text-indigo-600"></i>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">
              <?php echo $translations['passo2_titulo'] ?? '2. Escolha o Plano Ideal'; ?>
            </h3>
            <p class="text-gray-600">
              <?php echo $translations['passo2_desc'] ?? 'Compare nossos planos e selecione aquele que melhor atende suas necessidades.'; ?>
            </p>
          </div>
        </div>
      </div>
      <div class="bg-white p-8 rounded-xl shadow-lg">
        <div class="flex items-start mb-6">
          <div class="bg-indigo-100 p-3 rounded-lg mr-4">
            <i data-lucide="phone" class="w-6 h-6 text-indigo-600"></i>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">
              <?php echo $translations['passo3_titulo'] ?? '3. Entre em Contato'; ?>
            </h3>
            <p class="text-gray-600">
              <?php echo $translations['passo3_desc'] ?? 'Fale conosco via WhatsApp ou formulário para agendar a instalação.'; ?>
            </p>
          </div>
        </div>
      </div>
      <div class="bg-white p-8 rounded-xl shadow-lg">
        <div class="flex items-start mb-6">
          <div class="bg-indigo-100 p-3 rounded-lg mr-4">
            <i data-lucide="home" class="w-6 h-6 text-indigo-600"></i>
          </div>
          <div>
            <h3 class="text-xl font-semibold mb-2">
              <?php echo $translations['passo4_titulo'] ?? '4. Instalação e Ativação'; ?>
            </h3>
            <p class="text-gray-600">
              <?php echo $translations['passo4_desc'] ?? 'Nossa equipe cuida de tudo para você ter internet funcionando rapidamente.'; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Depoimentos -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-center mb-12">
      <?php echo $translations['depoimentos_titulo'] ?? 'O que Nossos Clientes Dizem'; ?>
    </h2>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-gray-50 p-6 rounded-xl">
        <div class="flex items-center mb-4">
          <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=60&h=60&fit=crop&crop=face" alt="Foto de Carlos Silva, cliente satisfeito da Hikari + Você" class="w-12 h-12 rounded-full mr-4">
          <div>
            <div class="font-semibold">Carlos Silva</div>
            <div class="text-sm text-gray-600">São Paulo, Brasil</div>
          </div>
        </div>
        <div class="flex mb-4">
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
        </div>
        <p class="text-gray-700 italic">
          "<?php echo $translations['depoimento1'] ?? 'Excelente serviço! O suporte em português fez toda diferença. Internet rápida e confiável para trabalhar remoto.'; ?>"
        </p>
      </div>
      <div class="bg-gray-50 p-6 rounded-xl">
        <div class="flex items-center mb-4">
          <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=60&h=60&fit=crop&crop=face" alt="Foto de Maria Garcia, cliente satisfeita da Hikari + Você" class="w-12 h-12 rounded-full mr-4">
          <div>
            <div class="font-semibold">Maria Garcia</div>
            <div class="text-sm text-gray-600">Buenos Aires, Argentina</div>
          </div>
        </div>
        <div class="flex mb-4">
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
        </div>
        <p class="text-gray-700 italic">
          "<?php echo $translations['depoimento2'] ?? 'Instalação rápida e atendimento em espanhol. Perfeito para famílias latinas no Japão.'; ?>"
        </p>
      </div>
      <div class="bg-gray-50 p-6 rounded-xl">
        <div class="flex items-center mb-4">
          <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=60&h=60&fit=crop&crop=face" alt="Foto de João Pereira, cliente satisfeito da Hikari + Você" class="w-12 h-12 rounded-full mr-4">
          <div>
            <div class="font-semibold">João Pereira</div>
            <div class="text-sm text-gray-600">Rio de Janeiro, Brasil</div>
          </div>
        </div>
        <div class="flex mb-4">
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
          <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
        </div>
        <p class="text-gray-700 italic">
          <?php echo $translations['depoimento3'] ?? 'Melhor decisão! Suporte 24/7 e preços competitivos. Recomendo para todos os brasileiros.'; ?>
        </p>
      </div>
    </div>
  </div>
</section>