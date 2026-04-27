<?php
require_once __DIR__ . '/../core/Database.php';

class Purchase
{
    private PDO $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(?int $userId = null): array
    {
        $sql = "SELECT p.id, u.full_name as client_name, pr.name as product_name, p.count, p.purchase_date, (p.count * pr.price) as total_price 
                FROM purchases p 
                JOIN users u ON p.user_id = u.id 
                JOIN products pr ON p.product_id = pr.id";

        $params = [];
        if ($userId !== null) {
            $sql .= " WHERE p.user_id = ?";
            $params[] = $userId;
        }
        $sql .= " ORDER BY p.purchase_date DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function makePurchase(int $userId, int $productId, int $count): bool
    {
        $stmt = $this->db->prepare("SELECT quantity FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch();

        if (!$product || $product['quantity'] < $count || $count <= 0)
            return false;

        $this->db->beginTransaction();
        try {
            $this->db->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ?")->execute([$count, $productId]);
            $this->db->prepare("INSERT INTO purchases (user_id, product_id, count) VALUES (?, ?, ?)")->execute([$userId, $productId, $count]);
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}