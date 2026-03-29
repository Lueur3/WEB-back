<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $price = $_POST['price'] ?? '';
    $category = $_POST['category'] ?? '';

    if (!empty($name) && !empty($brand) && !empty($price) && !empty($category)) {
        $stmt = $pdo->prepare("INSERT INTO products (name, brand, price, category) VALUES (?, ?, ?, ?)");

        $stmt->execute([$name, $brand, $price, $category]);
    }
}

header("Location: index.php");
exit();