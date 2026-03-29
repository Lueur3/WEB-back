<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $price = $_POST['price'] ?? '';
    $category = $_POST['category'] ?? '';

    if (!empty($name) && !empty($brand) && !empty($price) && !empty($category)) {
        $file = '/var/www/data/products.csv';

        if (!is_dir('/var/www/data')) {
            mkdir('/var/www/data', 0777, true);
        }

        $data = [$name, $brand, $price, $category];

        $handle = fopen($file, 'a');
        fputcsv($handle, $data, ";");
        fclose($handle);
    }
}

header("Location: index.php");
exit();