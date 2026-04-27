<?php
require_once __DIR__ . '/../core/Database.php';

class User
{
    private PDO $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create(string $username, string $password, string $full_name, string $role = 'user'): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password, full_name, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $hashedPassword, $full_name, $role]);
    }

    public function getByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch() ?: null;
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}