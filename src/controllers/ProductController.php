<?php

require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    private Product $model;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function index(): void
    {
        $filters = [
            'search' => $_GET['search'] ?? null,
            'category' => $_GET['category'] ?? null,
            'min_price' => $_GET['min_price'] ?? null,
            'max_price' => $_GET['max_price'] ?? null,
        ];

        $products = $this->model->getAll($filters);
        require __DIR__ . '/../views/index.php';
    }

    public function add_item(): void
    {
        require __DIR__ . '/../views/addItem.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'brand' => $_POST['brand'] ?? '',
                'price' => $_POST['price'] ?? 0,
                'category' => $_POST['category'] ?? ''
            ];

            if ($this->model->saveItem($data)) {
                header('Location: /');
                exit();
            }

            http_response_code(500);
            echo "Ошибка при сохранении данных.";
        }
    }
}