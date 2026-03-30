<?php

require_once __DIR__ . '/../core/Database.php';

class Product
{
    private PDO $db;

    public function __construct()
    {

        $this->db = Database::getConnection();
    }

    public function getAll(?string $search = null): array
    {
        if ($search) {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE name LIKE ? OR brand LIKE ? ORDER BY id DESC");
            $stmt->execute(["%$search%", "%$search%"]);
            return $stmt->fetchAll();
        }

        $stmt = $this->db->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO products (name, brand, price, category) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['name'],
            $data['brand'],
            $data['price'],
            $data['category']
        ]);
    }
}