#!/bin/bash
# Script de Deploy para Hikari + Você
# Execute com: sudo bash deploy.sh

echo "🚀 Iniciando deploy do Hikari + Você..."

# Verificar se é root
if [ "$EUID" -ne 0 ]; then
    echo "❌ Execute como root: sudo bash deploy.sh"
    exit 1
fi

# 1. Instalar dependências
echo "📦 Instalando dependências..."
apt update
apt install -y apache2 mysql-server php8.1 php8.1-mysql php8.1-mbstring php8.1-xml php8.1-curl php8.1-zip php8.1-gd

# 2. Configurar Apache
echo "🌐 Configurando Apache..."
cp /var/www/html/hikari-plus-voce/apache-config.conf /etc/apache2/sites-available/hikari-voce.conf
a2ensite hikari-voce
a2enmod rewrite
systemctl restart apache2

# 3. Configurar banco de dados
echo "🗄️ Configurando banco de dados..."
mysql -u root << EOF
CREATE DATABASE IF NOT EXISTS hikari_plus_voce CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'hikari_user'@'localhost' IDENTIFIED BY 'sua_senha_segura_aqui';
GRANT ALL PRIVILEGES ON hikari_plus_voce.* TO 'hikari_user'@'localhost';
FLUSH PRIVILEGES;
EOF

# 4. Importar dados do banco
echo "📊 Importando dados do banco..."
mysql -u hikari_user -p sua_senha_segura_aqui hikari_plus_voce < /var/www/html/hikari-plus-voce/database_backup.sql

# 5. Configurar permissões
echo "🔐 Configurando permissões..."
chown -R www-data:www-data /var/www/html/hikari-plus-voce
chmod -R 755 /var/www/html/hikari-plus-voce
chmod -R 777 /var/www/html/hikari-plus-voce/src/cache
chmod -R 777 /var/www/html/hikari-plus-voce/src/logs
chmod -R 777 /var/www/html/hikari-plus-voce/public/uploads

# 6. Configurar firewall
echo "🔥 Configurando firewall..."
ufw allow 'Apache Full'

# 7. Testar instalação
echo "🧪 Testando instalação..."
curl -s http://localhost | grep -q "Hikari" && echo "✅ Site funcionando!" || echo "❌ Erro no site"

echo "🎉 Deploy concluído!"
echo ""
echo "📋 Próximos passos:"
echo "1. Configure o arquivo .env com suas credenciais reais"
echo "2. Configure o DNS para apontar para seu servidor"
echo "3. Configure SSL com Let's Encrypt: certbot --apache -d hikari-voce.com"
echo "4. Acesse: http://hikari-voce.com"
