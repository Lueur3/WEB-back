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
        $search = $_GET['search'] ?? null;
        $products = $this->model->getAll($search);

        require __DIR__ . '/../views/index.php';
    }

    public function create(): void
    {
        require __DIR__ . '/../views/create.php';
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

            if ($this->model->create($data)) {
                header('Location: /');
                exit();
            }

            http_response_code(500);
            echo "Ошибка при сохранении данных.";
        }
    }
}