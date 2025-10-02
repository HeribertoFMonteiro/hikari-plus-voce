<?php
/**
 * seed.php
 * Script para criar banco de dados, tabelas e inserir dados iniciais
 * Rodar apenas uma vez
 */

// Configurações do MySQL
$host = 'localhost';
$user = 'heriberto';
$pass = '0631'; // Coloque sua senha do MySQL aqui
$dbname = 'hikari_plus_voce';

try {
    // Conectar ao MySQL sem banco (para criar)
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar banco de dados
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Banco de dados criado com sucesso.\n";

    // Conectar ao banco recém-criado
    $pdo->exec("USE $dbname");

    // =========================
    // Tabela users
    // =========================
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL,
            nivel_acesso ENUM('admin','editor') DEFAULT 'admin',
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    echo "Tabela users criada.\n";

    // Inserir usuário admin (senha: admin123)
    $senhaHash = password_hash('admin123', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (nome,email,senha) VALUES ('Administrador','admin@hikari.com',:senha) ON DUPLICATE KEY UPDATE senha=:senha");
    $stmt->execute(['senha' => $senhaHash]);
    echo "Usuário admin inserido.\n";

    // =========================
    // Tabela planos
    // =========================
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS planos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(50) NOT NULL,
            descricao VARCHAR(255) NOT NULL,
            preco DECIMAL(10,2) NOT NULL,
            velocidade VARCHAR(50) NOT NULL,
            beneficios TEXT NOT NULL,
            destaque BOOLEAN DEFAULT 0,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    echo "Tabela planos criada.\n";

    // Inserir planos iniciais
    $planos = [
        ['Plano Básico','Ideal para navegação diária e streaming leve.',3980.00,'200 Mbps','Suporte via WhatsApp; Instalação grátis',0],
        ['Plano Avançado','Perfeito para famílias, gamers e streaming 4K.',5980.00,'1 Gbps','Suporte multilíngue; Roteador Wi-Fi incluso',1],
        ['Plano Premium','Para empresas e usuários que precisam de máxima performance.',8980.00,'2 Gbps','IP fixo incluso; Suporte prioritário 24/7',0]
    ];

    $stmt = $pdo->prepare("INSERT INTO planos (nome,descricao,preco,velocidade,beneficios,destaque) VALUES (?,?,?,?,?,?)");
    foreach ($planos as $p) { $stmt->execute($p); }
    echo "Planos inseridos.\n";

    // =========================
    // Tabela leads
    // =========================
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS leads (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(100),
            telefone VARCHAR(50),
            plano_interesse VARCHAR(50),
            mensagem TEXT,
            idioma ENUM('pt','es') DEFAULT 'pt',
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    echo "Tabela leads criada.\n";

    // =========================
    // Tabela blog_posts
    // =========================
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS blog_posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(255) NOT NULL,
            slug VARCHAR(255) NOT NULL UNIQUE,
            conteudo TEXT NOT NULL,
            idioma ENUM('pt','es') DEFAULT 'pt',
            publicado BOOLEAN DEFAULT 0,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    echo "Tabela blog_posts criada.\n";

    $blogPosts = [
        ['Como contratar internet no Japão em português','como-contratar-internet-japao','Aprenda passo a passo como contratar internet de qualidade no Japão em português.','pt',1],
        ['Diferencia entre fibra y 5G','diferencia-fibra-5g','Descubre las diferencias entre fibra óptica y 5G para tu hogar o empresa.','es',1]
    ];
    $stmt = $pdo->prepare("INSERT INTO blog_posts (titulo,slug,conteudo,idioma,publicado) VALUES (?,?,?,?,?)");
    foreach ($blogPosts as $b) { $stmt->execute($b); }
    echo "Posts de blog inseridos.\n";

    // =========================
    // Tabela translations
    // =========================
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS translations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            chave VARCHAR(100) NOT NULL UNIQUE,
            pt TEXT,
            es TEXT
        )
    ");
    echo "Tabela translations criada.\n";

    $translations = [
        ['bem_vindo','Bem-vindo ao Hikari + Você!','¡Bienvenido a Hikari + Usted!'],
        ['contratar_agora','Contratar Agora','Contratar Ahora'],
        ['planos','Planos','Planes'],
        ['sobre','Sobre','Sobre'],
        ['cobertura','Cobertura','Cobertura'],
        ['contato','Contato','Contacto']
    ];
    $stmt = $pdo->prepare("INSERT INTO translations (chave,pt,es) VALUES (?,?,?) ON DUPLICATE KEY UPDATE pt=VALUES(pt), es=VALUES(es)");
    foreach ($translations as $t) { $stmt->execute($t); }
    echo "Traduções inseridas.\n";

    echo "\n✅ Seed concluído com sucesso!";
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
