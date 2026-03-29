<?php
require 'db.php';

$file = '/var/www/data/products.csv';

if (!file_exists($file)) {
    die("Файл CSV не найден.");
}

$handle = fopen($file, 'r');
$stmt = $pdo->prepare("INSERT INTO products (name, brand, price, category) VALUES (?, ?, ?, ?)");

$count = 0;
while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    $stmt->execute([$data[0], $data[1], $data[2], $data[3]]);
    $count++;
}

fclose($handle);
echo "Миграция завершена. Перенесено записей: $count";