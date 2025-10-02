# 🚀 Deploy - Hikari + Você

## 📋 Guia de Configuração para Produção

### **Passo 1: Configurar .env**
```bash
# 1. Edite o arquivo .env com suas credenciais reais:
APP_URL=https://seu-dominio.com
DB_PASS=sua-senha-real-do-banco
MAIL_PASSWORD=sua-senha-app-gmail

# 2. Configure produção no config.php:
# APP_DEBUG=false já está configurado
```

### **Passo 2: Configurar Servidor Web**

#### **Apache (Recomendado)**
```bash
# 1. Copie a configuração:
sudo cp apache-config.conf /etc/apache2/sites-available/hikari-voce.conf

# 2. Habilite o site e módulos:
sudo a2ensite hikari-voce
sudo a2enmod rewrite
sudo systemctl restart apache2
```

#### **Nginx (Alternativa)**
```bash
# 1. Copie a configuração:
sudo cp nginx-config.conf /etc/nginx/sites-available/hikari-voce

# 2. Habilite o site:
sudo ln -s /etc/nginx/sites-available/hikari-voce /etc/nginx/sites-enabled/
sudo systemctl restart nginx
```

### **Passo 3: Configurar Banco de Dados**
```sql
-- Execute no MySQL:
CREATE DATABASE hikari_plus_voce CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'hikari_user'@'localhost' IDENTIFIED BY 'sua_senha_segura';
GRANT ALL PRIVILEGES ON hikari_plus_voce.* TO 'hikari_user'@'localhost';
FLUSH PRIVILEGES;
```

### **Passo 4: Deploy Automatizado**
```bash
# Execute o script de deploy (como root):
sudo bash deploy.sh
```

### **Passo 5: Configurar SSL (HTTPS)**
```bash
# Instalar Let's Encrypt:
sudo apt install certbot python3-certbot-apache

# Gerar certificado:
sudo certbot --apache -d hikari-voce.com -d www.hikari-voce.com
```

---

## 🔧 Configurações de Produção

### **Arquivo .env - Credenciais Reais**
```env
# Ambiente
APP_ENV=production
APP_DEBUG=false
APP_URL=https://hikari-voce.com

# Banco de dados
DB_HOST=localhost
DB_NAME=hikari_plus_voce
DB_USER=hikari_user
DB_PASS=sua_senha_real_aqui

# Email SMTP
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=contato@hikari-voce.com
MAIL_PASSWORD=sua_senha_app_gmail
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contato@hikari-voce.com
```

### **Permissões de Arquivos**
```bash
# Execute após upload:
chmod -R 755 /var/www/html/hikari-plus-voce
chmod -R 777 /var/www/html/hikari-plus-voce/src/cache
chmod -R 777 /var/www/html/hikari-plus-voce/src/logs
chmod -R 777 /var/www/html/hikari-plus-voce/public/uploads
```

---

## 🌐 URLs do Site

Após configuração, o site estará disponível em:

- **Homepage:** `https://hikari-voce.com`
- **Planos:** `https://hikari-voce.com/planos.php`
- **Contato:** `https://hikari-voce.com/contato.php`
- **Blog:** `https://hikari-voce.com/blog.php`
- **FAQ:** `https://hikari-voce.com/faq.php`

---

## 🛠️ Manutenção

### **Backup do Banco**
```bash
mysqldump -u hikari_user -p hikari_plus_voce > backup_$(date +%Y%m%d).sql
```

### **Logs de Erro**
```bash
# Ver logs:
tail -f /var/log/apache2/hikari-voce-error.log
tail -f /var/www/html/hikari-plus-voce/src/logs/*.log
```

### **Limpar Cache**
```bash
# Via interface web ou:
rm -rf /var/www/html/hikari-plus-voce/src/cache/*.cache
```

---

## 🚨 Segurança

- ✅ **HTTPS** obrigatório em produção
- ✅ **Headers de segurança** configurados
- ✅ **CSRF Protection** ativo
- ✅ **Rate Limiting** implementado
- ✅ **Dados sanitizados** em todos os inputs
- ✅ **SQL Injection** protegido com PDO prepared statements

---

## 📞 Suporte

Para problemas:
1. Verifique os logs de erro
2. Teste a conectividade do banco
3. Verifique permissões de arquivos
4. Confirme configurações no .env

**🎉 Parabéns! Seu site Hikari + Você está pronto para produção!** 🚀
