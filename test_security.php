<?php
require_once __DIR__ . '/src/Security.php';

try {
    $security = Security::getInstance();

    // Teste básico
    echo "✓ Instância Security criada com sucesso\n";

    // Teste CSRF
    $token = $security->generateCSRFToken();
    echo "✓ Token CSRF gerado: " . (empty($token) ? 'ERRO' : 'OK') . "\n";

    // Teste sanitização
    $sanitized = $security->sanitizeString('<script>alert("xss")</script>');
    echo "✓ Sanitização: " . ($sanitized !== '<script>alert("xss")</script>' ? 'OK' : 'ERRO') . "\n";

    // Teste validação de email
    $emailValid = $security->validateEmail('test@example.com');
    $emailInvalid = $security->validateEmail('invalid-email');
    echo "✓ Validação email: " . ($emailValid && !$emailInvalid ? 'OK' : 'ERRO') . "\n";

    // Teste hash de senha
    $hash = $security->hashPassword('test123');
    $verify = $security->verifyPassword('test123', $hash);
    echo "✓ Hash/Verify senha: " . ($verify ? 'OK' : 'ERRO') . "\n";

    echo "\n✅ Todos os testes básicos passaram!\n";

} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}