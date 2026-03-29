<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин электроники — Панель управления</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Управление товарами</h1>

        <section class="form-section">
            <h2>Добавить новый товар</h2>
            <form action="process.php" method="POST" class="main-form">
                <div class="form-group">
                    <label for="name">Наименование</label>
                    <input type="text" id="name" name="name" placeholder="Напр: iPhone 15" required>
                </div>
                <div class="form-group">
                    <label for="brand">Бренд</label>
                    <input type="text" id="brand" name="brand" placeholder="Напр: Apple" required>
                </div>
                <div class="form-group">
                    <label for="price">Цена (₽)</label>
                    <input type="number" id="price" name="price" step="0.01" placeholder="0.00" required>
                </div>
                <div class="form-group">
                    <label for="category">Категория</label>
                    <select id="category" name="category">
                        <option value="Смартфоны">Смартфоны</option>
                        <option value="Ноутбуки">Ноутбуки</option>
                        <option value="Аксессуары">Аксессуары</option>
                        <option value="Мониторы">Мониторы</option>
                    </select>
                </div>
                <button type="submit" class="btn-submit">Сохранить</button>
            </form>
        </section>

        <hr>

        <section class="list-section">
            <div class="list-header">
                <h2>Список товаров</h2>
                <form action="index.php" method="GET" class="search-form">
                    <input type="text" name="search" placeholder="Поиск по названию..."
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    <button type="submit" class="btn-search">Найти</button>
                    <?php if (!empty($_GET['search'])): ?>
                        <a href="index.php" class="btn-reset">Сброс</a>
                    <?php endif; ?>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Наименование</th>
                        <th>Бренд</th>
                        <th>Цена</th>
                        <th>Категория</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'db.php';

                    $search = $_GET['search'] ?? '';

                    if (!empty($search)) {
                        $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ? OR brand LIKE ?");
                        $stmt->execute(["%$search%", "%$search%"]);
                    } else {
                        $stmt = $pdo->query("SELECT * FROM products");
                    }

                    $products = $stmt->fetchAll();

                    foreach ($products as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['brand']) . "</td>";
                        echo "<td>" . number_format((float) $row['price'], 2, '.', ' ') . " ₽</td>";
                        echo "<td><span class='badge'>" . htmlspecialchars($row['category']) . "</span></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</body>

</html>