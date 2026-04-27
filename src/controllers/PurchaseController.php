<?php
require_once __DIR__ . '/../models/Purchase.php';
require_once __DIR__ . '/../models/Product.php';

class PurchaseController
{
    private Purchase $purchaseModel;
    private Product $productModel;

    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
        $this->purchaseModel = new Purchase();
        $this->productModel = new Product();
    }

    public function index(): void
    {
        $userId = ($_SESSION['role'] === 'admin') ? null : $_SESSION['user_id'];
        $purchases = $this->purchaseModel->getAll($userId);
        require __DIR__ . '/../views/purchases/index.php';
    }

    public function create(): void
    {
        $productId = (int) ($_GET['product_id'] ?? 0);
        $product = $this->productModel->getById($productId);
        if (!$product) {
            header('Location: /');
            exit();
        }
        require __DIR__ . '/../views/purchases/create.php';
    }

    public function store(): void
    {
        $productId = (int) ($_POST['product_id'] ?? 0);
        $count = (int) ($_POST['count'] ?? 0);
        $userId = $_SESSION['user_id'];

        if ($this->purchaseModel->makePurchase($userId, $productId, $count)) {
            header('Location: /purchases');
            exit();
        }
        echo "Ошибка оформления. <a href='/'>Назад</a>";
    }
}