<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/src/Security.php';

class SecurityTest extends TestCase
{
    private $security;

    protected function setUp(): void
    {
        $this->security = Security::getInstance();
    }

    public function testGenerateCSRFToken()
    {
        $token = $this->security->generateCSRFToken();
        $this->assertIsString($token);
        $this->assertEquals(64, strlen($token)); // bin2hex(32) produces 64 chars
    }

    public function testVerifyCSRFTokenValid()
    {
        $token = $this->security->generateCSRFToken();
        $this->assertTrue($this->security->verifyCSRFToken($token));
    }

    public function testVerifyCSRFTokenInvalid()
    {
        $this->assertFalse($this->security->verifyCSRFToken('invalid_token'));
    }

    public function testSanitizeString()
    {
        $input = '<script>alert("xss")</script>';
        $sanitized = $this->security->sanitizeString($input);
        $this->assertEquals('alert(&quot;xss&quot;)', $sanitized);
    }

    public function testSanitizeEmail()
    {
        $email = 'test@example.com';
        $sanitized = $this->security->sanitizeEmail($email);
        $this->assertEquals($email, $sanitized);
    }

    public function testValidateEmail()
    {
        $this->assertTrue($this->security->validateEmail('test@example.com'));
        $this->assertFalse($this->security->validateEmail('invalid-email'));
    }

    public function testHashPassword()
    {
        $password = 'test123';
        $hash = $this->security->hashPassword($password);
        $this->assertIsString($hash);
        $this->assertNotEquals($password, $hash);
    }

    public function testVerifyPassword()
    {
        $password = 'test123';
        $hash = $this->security->hashPassword($password);
        $this->assertTrue($this->security->verifyPassword($password, $hash));
        $this->assertFalse($this->security->verifyPassword('wrong', $hash));
    }
}
?>
