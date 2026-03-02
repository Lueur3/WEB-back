<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $product_name = $_POST["prod_name"];
  $product_price = $_POST["price"];
  $product_quantity = $_POST["quantity"];
  $product_category = $_POST["category"];

  $data = array($product_name, $product_price, $product_quantity, $product_category);


  $dirPath = __DIR__ . "/data";
  $filePath = $dirPath . "/products.csv";

  if (!is_dir($dirPath)) {
    mkdir($dirPath, 0777, true);
  }

  $fd = @fopen($filePath, 'a');

  if (!$fd) {
    die("Ошибка: Не удалось открыть файл для записи. <a href='index.php'>Вернуться назад</a>");
  }

  fputcsv($fd, $data, ";");

  fclose($fd);


  $_SESSION['show_modal'] = true;
  header("Location: index.php");
  exit();
}

?>