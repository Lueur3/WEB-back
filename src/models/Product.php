<?php

require_once __DIR__ . '/../core/Database.php';

class Product
{
    private PDO $db;

    public function __construct()
    {

        $this->db = Database::getConnection();
    }

    public function getAll(?array $filters = []): array
    {
        $sql = "SELECT * FROM products WHERE 1=1";
        $params = [];


        if (!empty($filters['search'])) {
            $sql .= " AND (name LIKE ? OR brand LIKE ?)";
            $params[] = "%{$filters['search']}%";
            $params[] = "%{$filters['search']}%";
        }

        if (!empty($filters['category'])) {
            $sql .= " AND category = ?";
            $params[] = $filters['category'];
        }

        if (!empty($filters['min_price'])) {
            $sql .= " AND price >= ?";
            $params[] = $filters['min_price'];
        }

        if (!empty($filters['max_price'])) {
            $sql .= " AND price <= ?";
            $params[] = $filters['max_price'];
        }

        $sql .= " ORDER BY id DESC";


        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function saveItem(array $data): bool
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