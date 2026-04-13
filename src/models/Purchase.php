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
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("SELECT quantity FROM products WHERE id = ? FOR UPDATE");
            $stmt->execute([$productId]);
            $product = $stmt->fetch();

            if (!$product || $product['quantity'] < $count) {
                $this->db->rollBack();
                return false;
            }

            $stmt = $this->db->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ?");
            $stmt->execute([$count, $productId]);

            $stmt = $this->db->prepare("INSERT INTO purchases (client_id, product_id, count) VALUES (?, ?, ?)");
            $stmt->execute([$clientId, $productId, $count]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}