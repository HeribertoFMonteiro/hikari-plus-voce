<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/src/Models/Database.php';
require_once __DIR__ . '/src/Cache.php';
require_once __DIR__ . '/src/Logger.php';

class DatabaseTest extends TestCase
{
    private $db;

    protected function setUp(): void
    {
        // For testing, you might want to use a test database or mock
        // For now, assuming connection works
        $this->db = Database::getInstance();
    }

    public function testGetConnection()
    {
        $pdo = $this->db->getConnection();
        $this->assertInstanceOf(PDO::class, $pdo);
    }

    public function testPing()
    {
        $this->assertTrue($this->db->ping());
    }

    public function testQuery()
    {
        // Assuming a simple query, adjust based on your schema
        $result = $this->db->query("SELECT 1 as test");
        $this->assertIsArray($result);
        $this->assertEquals(1, $result[0]['test']);
    }

    public function testExecute()
    {
        // Test a simple insert if possible, but be careful with test data
        $this->assertTrue($this->db->execute("SELECT 1"));
    }

    public function testGetTranslations()
    {
        $translations = $this->db->getTranslations('pt');
        $this->assertIsArray($translations);
    }

    public function testClearCache()
    {
        $this->db->clearCache();
        $this->assertTrue(true); // Just ensure no errors
    }
}
?>
