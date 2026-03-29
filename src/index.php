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
            <h2>Добавить новый товар (POST)</h2>
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
                <button type="submit" class="btn-submit">Сохранить в CSV</button>
            </form>
        </section>

        <hr>

        <section class="list-section">
            <div class="list-header">
                <h2>Список товаров</h2>
                <form action="index.php" method="GET" class="search-form">
                    <input type="text" name="search" placeholder="Поиск по названию..."
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    <button type="submit" class="btn-search">Найти (GET)</button>
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
                    $file = '/var/www/data/products.csv';
                    $search = $_GET['search'] ?? '';

                    if (file_exists($file)) {
                        if (($handle = fopen($file, "r")) !== FALSE) {
                            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                                // Обработка GET-запроса: фильтрация
                                if (!empty($search)) {
                                    $found = false;
                                    if (mb_stripos($data[0], $search) !== false || mb_stripos($data[1], $search) !== false) {
                                        $found = true;
                                    }
                                    if (!$found)
                                        continue;
                                }

                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($data[0]) . "</td>";
                                echo "<td>" . htmlspecialchars($data[1]) . "</td>";
                                echo "<td>" . number_format((float) $data[2], 2, '.', ' ') . " ₽</td>";
                                echo "<td><span class='badge'>" . htmlspecialchars($data[3]) . "</span></td>";
                                echo "</tr>";
                            }
                            fclose($handle);
                        }
                    } else {
                        echo "<tr><td colspan='4' style='text-align:center'>Данные отсутствуют</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</body>

</html>