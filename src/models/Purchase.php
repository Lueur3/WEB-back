<?php

require_once __DIR__ . '/../core/Database.php';

class Purchase
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT 
                    p.id,
                    c.full_name as client_name,
                    pr.name as product_name,
                    p.count,
                    p.purchase_date,
                    (p.count * pr.price) as total_price
                FROM purchases p
                JOIN clients c ON p.client_id = c.id
                JOIN products pr ON p.product_id = pr.id
                ORDER BY p.purchase_date DESC";

        return $this->db->query($sql)->fetchAll();
    }

    public function makePurchase(int $clientId, int $productId, int $count): bool
    {
        $stmt = $this->db->prepare("SELECT quantity FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch();

        if (!$product || $product['quantity'] < $count || $count == 0) {
            return false;
        }

        $updateStmt = $this->db->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ?");
        $updateResult = $updateStmt->execute([$count, $productId]);

        if (!$updateResult) {
            return false;
        }

        $insertStmt = $this->db->prepare("INSERT INTO purchases (client_id, product_id, count) VALUES (?, ?, ?)");
        return $insertStmt->execute([$clientId, $productId, $count]);
    }
}