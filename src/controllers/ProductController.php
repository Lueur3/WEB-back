<?php

require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    private Product $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function index(): void
    {
        $filters = [
            'search' => $_GET['search'] ?? null,
            'category' => $_GET['category'] ?? null,
            'min_price' => $_GET['min_price'] ?? null,
            'max_price' => $_GET['max_price'] ?? null,
        ];

        $products = $this->productModel->getAll($filters);
        require __DIR__ . '/../views/products/index.php';
    }

    public function create(): void
    {
        require __DIR__ . '/../views/products/create.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'brand' => $_POST['brand'] ?? '',
                'price' => $_POST['price'] ?? 0,
                'category' => $_POST['category'] ?? '',
                'quantity' => $_POST['quantity'] ?? 0
            ];

            if ($this->productModel->create($data)) {
                header('Location: /');
                exit();
            }
        }
    }
}