<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>LR2</title>
</head>

<body>

  <div class="container">
    <form class="form" action="process.php" method="post">
      <h2>Добавление товара</h2>

      <div class="form-group">
        <label for="prod_name">Название товара</label>
        <input type="text" id="prod_name" name="prod_name" placeholder="Напр: Смартфон" minlength="2" maxlength="20"
          required>
      </div>

      <div class="form-group">
        <label for="brand">Бренд</label>
        <input type="text" id="brand" name="brand" placeholder="Напр: Apple" minlength="2" maxlength="20" required>
      </div>

      <div class="row">
        <div class="form-group">
          <label for="price">Цена</label>
          <input type="number" id="price" name="price" placeholder="0.00" type="number" min="0.1" step="0.1" required>
        </div>
        <div class="form-group">
          <label for="quantity">Кол-во</label>
          <input type="number" id="quantity" name="quantity" placeholder="1" type="number" min="1" step="1" required>
        </div>
      </div>

      <div class="form-group">
        <label for="category">Категория</label>
        <input type="text" id="category" name="category" placeholder="Электроника" minlength="2" maxlength="20"
          required>
      </div>

      <button class="add-btn" type="submit">Добавить товар</button>

      <div style="text-align: center; margin-top: 20px;">
        <a href="index.php?show" style="color: #007bff; text-decoration: none; font-weight: bold;">Показать все
          товары</a>
        <?php if (isset($_GET['show'])): ?>
          | <a href="index.php" style="color: #666; text-decoration: none;">Скрыть</a>
        <?php endif; ?>
      </div>

    </form>
  </div>

</body>


<?php if (isset($_SESSION['show_modal'])): ?>
  <div id="modal" class="modal-overlay">
    <div class="modal-content">
      <p>Товар успешно добавлен в базу</p>
      <button onclick="document.getElementById('modal').style.display='none'">Отлично</button>
    </div>
  </div>
  <?php
  unset($_SESSION['show_modal']);
endif;
if (isset($_GET['show'])) {
  $filePath = __DIR__ . "/data/products.csv";

  if (file_exists($filePath) && filesize($filePath) > 0) {
    echo "<div class='container' style='height: auto; padding: 20px;'>";
    echo "<div class='form' style='max-width: 600px;'>";
    echo "<h3>Список товаров</h3>";
    echo "<table style='width:100%; border-collapse: collapse; margin-top: 15px;'>";
    echo "<tr style='background: #f0f2f5;'>
                <th style='padding: 10px; border: 1px solid #ddd;'>Товар</th>
                <th style='padding: 10px; border: 1px solid #ddd;'>Цена</th>
                <th style='padding: 10px; border: 1px solid #ddd;'>Кол-во</th>
                <th style='padding: 10px; border: 1px solid #ddd;'>Категория</th>
              </tr>";

    if (($handle = fopen($filePath, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        if (empty($data[0]))
          continue;

        echo "<tr>";
        foreach ($data as $cell) {
          echo "<td style='padding: 10px; border: 1px solid #ddd; text-align: center;'>"
            . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
      }
      fclose($handle);
    }
    echo "</table>";
    echo "</div></div>";
  } else {
    echo "<p style='text-align:center; color: #666; margin-top: 20px;'>Файл пуст или еще не создан.</p>";
  }
}


?>

</html>