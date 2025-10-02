#!/bin/bash
# backup.sh - Script de backup automático do banco de dados e arquivos

# Configurações
BACKUP_DIR="/var/backups/hikari-plus-voce"
DB_HOST="localhost"
DB_NAME="hikari_plus_voce"
DB_USER="heriberto"
DB_PASS="0631"
DATE=$(date +%Y%m%d_%H%M%S)
RETENTION_DAYS=30

# Criar diretório de backup se não existir
mkdir -p $BACKUP_DIR

echo "Iniciando backup em $(date)"

# Backup do banco de dados
echo "Fazendo backup do banco de dados..."
mysqldump -h $DB_HOST -u $DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/db_backup_$DATE.sql

if [ $? -eq 0 ]; then
    echo "✅ Backup do banco criado com sucesso: db_backup_$DATE.sql"
else
    echo "❌ Erro no backup do banco de dados"
    exit 1
fi

# Backup dos arquivos do site
echo "Fazendo backup dos arquivos..."
tar -czf $BACKUP_DIR/site_backup_$DATE.tar.gz /var/www/html/hikari-plus-voce \
    --exclude='*.log' \
    --exclude='cache/*' \
    --exclude='node_modules' \
    --exclude='.git'

if [ $? -eq 0 ]; then
    echo "✅ Backup dos arquivos criado com sucesso: site_backup_$DATE.tar.gz"
else
    echo "❌ Erro no backup dos arquivos"
    exit 1
fi

# Compactar tudo em um arquivo único
echo "Criando arquivo consolidado..."
tar -czf $BACKUP_DIR/full_backup_$DATE.tar.gz -C $BACKUP_DIR \
    db_backup_$DATE.sql \
    site_backup_$DATE.tar.gz

if [ $? -eq 0 ]; then
    echo "✅ Backup consolidado criado: full_backup_$DATE.tar.gz"
else
    echo "❌ Erro ao criar backup consolidado"
    exit 1
fi

# Limpar backups antigos (mais de 30 dias)
echo "Limpando backups antigos..."
find $BACKUP_DIR -name "*.sql" -mtime +$RETENTION_DAYS -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +$RETENTION_DAYS -delete

echo "Backup concluído com sucesso!"
echo "Local dos backups: $BACKUP_DIR"
echo "Próximo backup automático em: $(date -d '+1 day' '+%Y-%m-%d %H:%M:%S')"
