# Hikari + Você - Site de Internet para Brasileiros no Japão

## 📋 Descrição

Site institucional para a empresa Hikari + Você, especializada em fornecer internet de alta velocidade para brasileiros e latinos residentes no Japão. O site oferece planos de fibra ótica com suporte personalizado em português e espanhol.

## 🚀 Funcionalidades

- **Páginas Institucionais**: Home, Sobre, Planos, Cobertura, Contato, Como Funciona, FAQ
- **Sistema Bilíngue**: Suporte completo em português e espanhol
- **Blog**: Sistema de posts bilíngue com paginação
- **Formulário de Contato**: Coleta de leads com validação e sanitização
- **Design Responsivo**: Otimizado para desktop e mobile
- **SEO Otimizado**: Meta tags, Schema.org e URLs amigáveis
- **Segurança**: Proteção CSRF, rate limiting, sanitização de dados
- **Performance**: Cache, compressão GZIP, minificação HTML
- **Monitoramento**: Sistema de logs estruturado

## 🛠️ Tecnologias Utilizadas

### Backend
- **PHP 8.1+** com arquitetura MVC completa
- **Banco de Dados**: MySQL 8.0+ com PDO
- **Sistema de Cache**: Cache personalizado com TTL
- **Logs**: Sistema de logging estruturado
- **Segurança**: Sanitização, validação, proteção CSRF

### Frontend
- **HTML5** semântico e acessível
- **CSS3** com Tailwind CSS
- **JavaScript** vanilla para interatividade
- **Ícones**: Lucide Icons

### Infraestrutura
- **URL Rewriting** com mod_rewrite
- **Compressão GZIP** automática
- **Cache de Assets** com headers apropriados
- **HTTPS** obrigatório em produção

## 📁 Estrutura do Projeto

```
hikari-plus-voce/
├── src/
│   ├── Config/
│   │   ├── config.php          # Configurações principais
│   │   └── .env.example        # Exemplo de variáveis de ambiente
│   ├── Controllers/            # Controladores MVC
│   │   ├── HomeController.php
│   │   ├── PlanosController.php
│   │   ├── AboutController.php
│   │   ├── ContatoController.php
│   │   ├── CoberturaController.php
│   │   ├── BlogController.php
│   │   ├── PostController.php
│   │   ├── ComoFuncionaController.php
│   │   └── FaqController.php
│   ├── Models/
│   │   └── Database.php         # Conexão e operações DB
│   ├── Views/                   # Templates das páginas
│   │   ├── header.php
│   │   ├── footer.php
│   │   ├── home.php
│   │   ├── planos.php
│   │   ├── about.php
│   │   ├── contato.php
│   │   ├── cobertura.php
│   │   ├── blog.php
│   │   ├── post.php
│   │   ├── como-funciona.php
│   │   └── faq.php
│   ├── Cache.php                # Sistema de cache
│   ├── Logger.php               # Sistema de logs
│   ├── Router.php               # Roteamento MVC
│   ├── Security.php             # Utilitários de segurança
│   └── Performance.php          # Otimizações de performance
├── public/
│   ├── index.php                # Front Controller
│   ├── .htaccess                # Regras de URL rewriting
│   └── assets/                  # CSS, JS, imagens
├── database/
│   └── hikari.sql               # Schema do banco
├── cache/                       # Arquivos de cache (criado automaticamente)
├── logs/                        # Arquivos de log (criado automaticamente)
├── backup.sh                    # Script de backup
├── .env.example                 # Exemplo de configuração
├── seed.php                     # Populador do banco
└── README.md
```

## ⚙️ Instalação e Configuração

### 1. Pré-requisitos
- **PHP 8.1+** com extensões: `pdo_mysql`, `mbstring`, `zlib`
- **MySQL 8.0+**
- **Apache/Nginx** com `mod_rewrite`
- **Composer** (opcional)

### 2. Instalação
```bash
# Clonar repositório
git clone https://github.com/seu-usuario/hikari-plus-voce.git
cd hikari-plus-voce

# Instalar dependências (se houver composer.json)
composer install

# Configurar banco de dados
mysql -u root -p < database/hikari.sql

# Popular banco com dados iniciais
php seed.php
```

### 3. Configuração
```bash
# Copiar arquivo de configuração
cp .env.example .env

# Editar configurações no .env
nano .env

# Configurar permissões
chmod +x backup.sh
chmod 755 cache/ logs/
```

### 4. Configuração do Servidor Web

#### Apache (.htaccess já incluído)
```apache
<VirtualHost *:80>
    ServerName hikari-voce.com
    DocumentRoot /var/www/html/hikari-plus-voce/public

    <Directory /var/www/html/hikari-plus-voce/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog /var/log/apache2/hikari-error.log
    CustomLog /var/log/apache2/hikari-access.log combined
</VirtualHost>
```

#### Nginx
```nginx
server {
    listen 80;
    server_name hikari-voce.com;
    root /var/www/html/hikari-plus-voce/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Cache de assets
    location ~* \.(css|js|png|jpg|jpeg|gif|svg|woff|woff2)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }

    # Compressão
    gzip on;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;
}
```

## 🔐 Segurança

O site implementa múltiplas camadas de segurança:

- **Proteção CSRF** em formulários
- **Rate Limiting** para prevenir abuso
- **Sanitização** de todas as entradas
- **Validação** de dados no servidor
- **Headers de Segurança** (CSP, HSTS, X-Frame-Options)
- **Logs de Auditoria** para ações importantes

## 📊 Monitoramento e Logs

### Logs Estruturados
```
logs/
├── 2024-01-15.log    # Logs por data
├── 2024-01-16.log
└── php_errors.log     # Erros PHP
```

### Tipos de Log
- **DEBUG**: Informações de desenvolvimento
- **INFO**: Ações do usuário (login, contato, etc.)
- **WARNING**: Avisos não críticos
- **ERROR**: Erros que precisam atenção
- **CRITICAL**: Erros críticos do sistema

## 🔄 Backup Automático

### Configuração do Cron
```bash
# Backup diário às 2:00 AM
0 2 * * * /var/www/html/hikari-plus-voce/backup.sh

# Ou configurar via systemd timer
```

### Estrutura de Backup
```
backups/
├── db_backup_20240115_020000.sql      # Backup do banco
├── site_backup_20240115_020000.tar.gz # Backup dos arquivos
└── full_backup_20240115_020000.tar.gz # Backup consolidado
```

## 🚀 Deploy em Produção

### Checklist Pré-Deploy
- [ ] Configurar domínio e SSL
- [ ] Atualizar `APP_ENV=production` no .env
- [ ] Configurar chaves secretas fortes
- [ ] Testar todas as funcionalidades
- [ ] Configurar monitoramento
- [ ] Configurar backups automáticos

### Otimizações de Produção
```bash
# Limpar cache de desenvolvimento
php -r "require 'src/Config/config.php'; Database::getInstance()->clearCache();"

# Configurar permissões corretas
chown -R www-data:www-data /var/www/html/hikari-plus-voce
chmod -R 755 /var/www/html/hikari-plus-voce
chmod -R 777 cache/ logs/  # Apenas para escrita
```

## 📈 Performance

### Otimizações Implementadas
- **Cache Inteligente**: Consultas frequentes em cache
- **Compressão GZIP**: Redução de 60-80% no tamanho
- **Minificação HTML**: Remoção de espaços desnecessários
- **Lazy Loading**: Imagens carregadas sob demanda
- **CDN Ready**: Preparado para CDN de assets

### Métricas Esperadas
- **Tempo de Carregamento**: < 2 segundos
- **Score Lighthouse**: > 90 pontos
- **Tamanho da Página**: < 500KB comprimido

## 🐛 Troubleshooting

### Problemas Comuns

**Erro de Conexão DB:**
```bash
# Verificar credenciais
php -r "require 'src/Config/config.php'; echo 'Conexão OK';"
```

**Permissões de Arquivo:**
```bash
# Corrigir permissões
chmod 755 cache/ logs/
chmod 644 src/Config/config.php
```

**Cache Cheio:**
```bash
# Limpar cache manualmente
rm -rf cache/*.cache
```

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. Commit suas mudanças (`git commit -am 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um Pull Request

## 📄 Licença

Este projeto é propriedade da Hikari + Você. Todos os direitos reservados.

## 📞 Suporte

Para suporte técnico:
- **Email**: suporte@hikari-voce.com
- **WhatsApp**: +55 11 99999-9999
- **Horário**: 24/7 em português e espanhol

---

**Desenvolvido com ❤️ para a comunidade brasileira no Japão**
├── public/                 # Arquivos públicos
│   ├── index.php          # Página inicial
│   ├── about.php          # Sobre a empresa
│   ├── planos.php         # Planos de internet
│   ├── cobertura.php      # Áreas de cobertura
│   ├── contato.php        # Página de contato
│   ├── blog.php           # Lista de posts do blog
│   ├── post.php           # Post individual do blog
│   ├── assets/            # Recursos estáticos
│   │   ├── css/
│   │   │   └── style.css  # Estilos customizados
│   │   ├── js/
│   │   └── images/
│   └── .htaccess          # Regras de reescrita URL
├── src/                   # Código fonte
│   ├── Config/
│   │   └── config.php     # Configurações do banco
│   ├── Controllers/       # Controladores MVC
│   │   ├── HomeController.php
│   │   └── PlanosController.php
│   ├── Models/
│   │   └── Database.php   # Conexão com banco
│   └── Views/             # Templates
│       ├── header.php     # Cabeçalho HTML
│       ├── footer.php     # Rodapé
│       └── layout.php     # Layout base
├── resources/             # Recursos auxiliares
│   ├── lang/              # Arquivos de tradução
│   │   ├── pt.json
│   │   └── es.json
│   └── partials/
│       └── navbar.php     # Barra de navegação
├── seed.php               # Script de população do banco
└── README.md              # Este arquivo
```

## ��️ Banco de Dados

### Tabelas Principais

- **users**: Usuários do sistema (admin)
- **planos**: Planos de internet disponíveis
- **leads**: Contatos e mensagens dos usuários
- **blog_posts**: Posts do blog bilíngue
- **translations**: Textos traduzidos

### Instalação do Banco

1. Criar banco MySQL: `hikari_plus_voce`
2. Executar `database/hikari.sql` ou rodar `php seed.php`

## 🌐 Configuração

### Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx)

### Configuração do Banco

Editar `src/Config/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'hikari_plus_voce');
define('DB_USER', 'seu_usuario');
define('DB_PASS', 'sua_senha');
```

## 🚀 Como Usar

1. **Instalar dependências**: Certifique-se que PHP e MySQL estão instalados
2. **Configurar banco**: Criar banco e executar seed.php
3. **Servir arquivos**: Usar servidor web apontando para `public/`
4. **Acessar**: `http://localhost` ou domínio configurado

### URLs Amigáveis

- `/pt/planos` → `planos.php?lang=pt`
- `/es/contacto` → `contato.php?lang=es`
- `/pt/blog` → `blog.php?lang=pt`

## 📞 Contato

Para dúvidas ou suporte técnico do projeto:
- Email: contato@hikari-voce.com
- WhatsApp: +55 11 99999-9999

## 📝 Licença

Este projeto é propriedade da Hikari + Você.
