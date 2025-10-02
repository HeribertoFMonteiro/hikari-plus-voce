#!/bin/bash
# Script para iniciar o servidor Hikari + Você
# Execute com: bash start-server.sh

echo "🚀 Iniciando servidor Hikari + Você..."

# Verificar se a porta 8000 está em uso
if lsof -Pi :8000 -sTCP:LISTEN -t >/dev/null ; then
    echo "✅ Servidor já está rodando na porta 8000"
    echo ""
    echo "🌐 URLs para acessar o site:"
    echo ""
    echo "🏠 Página Principal:"
    echo "   http://localhost:8000/"
    echo ""
    echo "📋 Páginas em Português:"
    echo "   http://localhost:8000/?page=planos"
    echo "   http://localhost:8000/?page=about"
    echo "   http://localhost:8000/?page=contato"
    echo "   http://localhost:8000/?page=cobertura"
    echo "   http://localhost:8000/?page=blog"
    echo "   http://localhost:8000/?page=faq"
    echo "   http://localhost:8000/?page=como-funciona"
    echo ""
    echo "📋 Páginas em Espanhol:"
    echo "   http://localhost:8000/?lang=es&page=planos"
    echo "   http://localhost:8000/?lang=es&page=about"
    echo "   http://localhost:8000/?lang=es&page=contato"
    echo ""
    echo "🛠️  Para parar o servidor: kill \$(lsof -ti:8000)"
    echo ""
    echo "🎉 Site funcionando! Abra http://localhost:8000/ no navegador"
else
    echo "🔄 Iniciando servidor na porta 8000..."
    cd /var/www/html/hikari-plus-voce/public
    nohup php -S localhost:8000 > /dev/null 2>&1 &
    sleep 2

    if lsof -Pi :8000 -sTCP:LISTEN -t >/dev/null ; then
        echo "✅ Servidor iniciado com sucesso!"
        echo ""
        echo "🌐 URLs para acessar o site:"
        echo ""
        echo "🏠 Página Principal:"
        echo "   http://localhost:8000/"
        echo ""
        echo "📋 Páginas em Português:"
        echo "   http://localhost:8000/?page=planos"
        echo "   http://localhost:8000/?page=about"
        echo "   http://localhost:8000/?page=contato"
        echo "   http://localhost:8000/?page=cobertura"
        echo "   http://localhost:8000/?page=blog"
        echo "   http://localhost:8000/?page=faq"
        echo "   http://localhost:8000/?page=como-funciona"
        echo ""
        echo "📋 Páginas em Espanhol:"
        echo "   http://localhost:8000/?lang=es&page=planos"
        echo "   http://localhost:8000/?lang=es&page=about"
        echo "   http://localhost:8000/?lang=es&page=contato"
        echo ""
        echo "🎉 Site funcionando! Abra http://localhost:8000/ no navegador"
    else
        echo "❌ Erro ao iniciar o servidor"
    fi
fi
