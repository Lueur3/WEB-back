<?php

require_once __DIR__ . '/../models/Purchase.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Client.php';

class PurchaseController
{
    private Purchase $purchaseModel;
    private Product $productModel;
    private Client $clientModel;

    public function __construct()
    {
        $this->purchaseModel = new Purchase();
        $this->productModel = new Product();
        $this->clientModel = new Client();
    }

    public function index(): void
    {
        $purchases = $this->purchaseModel->getAll();
        require __DIR__ . '/../views/purchases/index.php';
    }

    public function create(): void
    {
        $clients = $this->clientModel->getAll();
        $products = $this->productModel->getAll();
        require __DIR__ . '/../views/purchases/create.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clientId = (int) ($_POST['client_id'] ?? 0);
            $productId = (int) ($_POST['product_id'] ?? 0);
            $count = (int) ($_POST['count'] ?? 0);

            if ($this->purchaseModel->makePurchase($clientId, $productId, $count)) {
                header('Location: /purchases');
                exit();
            } else {
                echo "<h1>Ошибка</h1>";
                echo "<p>Недостаточно товара на складе или введены неверные данные.</p>";
                echo "<a href='/purchases/create'>Вернуться к оформлению</a> | ";
                echo "<a href='/'>Перейти в каталог</a>";
                return;
            }
        }
        header('Location: /purchases/create');
    }
}