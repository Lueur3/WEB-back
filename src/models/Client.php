<?php

require_once __DIR__ . '/../core/Database.php';

class Client
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM clients ORDER BY full_name ASC");
        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO clients (full_name, email, phone) VALUES (?, ?, ?)");
        return $stmt->execute([
            $data['full_name'],
            $data['email'],
            $data['phone']
        ]);
    }
}