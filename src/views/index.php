<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Магазин электроники — Управление</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <div class="container">
        <h1>Управление товарами</h1>

        <div class="list-header">
            <a href="/add-item" class="btn-search" style="text-decoration: none; background-color: #2563eb;">+ Добавить
                товар</a>

            <form action="/" method="GET" class="search-form"
                style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 20px;">
                <!-- Текстовый поиск -->
                <input type="text" name="search" placeholder="Поиск по названию/бренду..."
                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" style="flex: 1; min-width: 200px;">

                <!-- Фильтр по категории -->
                <select name="category" style="padding: 8px; border-radius: 6px; border: 1px solid #e2e8f0;">
                    <option value="">Все категории</option>
                    <?php
                    $categories = ['Смартфоны', 'Ноутбуки', 'Аксессуары', 'Мониторы'];
                    foreach ($categories as $cat):
                        $selected = ($_GET['category'] ?? '') === $cat ? 'selected' : '';
                        ?>
                        <option value="<?= $cat ?>" <?= $selected ?>><?= $cat ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Фильтр по цене -->
                <input type="number" name="min_price" placeholder="Цена от" step="0.01"
                    value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>" style="width: 100px;">

                <input type="number" name="max_price" placeholder="Цена до" step="0.01"
                    value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>" style="width: 100px;">

                <button type="submit" class="btn-search">Применить</button>

                <?php if (!empty($_GET)): ?>
                    <a href="/" class="btn-reset" style="align-self: center;">Сбросить</a>
                <?php endif; ?>
            </form>
        </div>

        <table style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Бренд</th>
                    <th>Цена</th>
                    <th>Категория</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= htmlspecialchars($product['brand']) ?></td>
                            <td><?= number_format((float) $product['price'], 2, '.', ' ') ?> ₽</td>
                            <td><span class="badge"><?= htmlspecialchars($product['category']) ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center; padding: 20px;">Товары не найдены по заданным фильтрам
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>