<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <div class="container">
        <nav>
            <a href="/">Товары</a> |
            <a href="/purchases">История покупок</a>
        </nav>
        <h1>Список товаров</h1>

        <div class="list-header">
            <a href="/create" class="btn-search" style="text-decoration: none; background-color: #2563eb;">+ Добавить
                товар</a>

            <form action="/" method="GET" class="search-form"
                style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 20px;">
                <input type="text" name="search" placeholder="Поиск..."
                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <select name="category">
                    <option value="">Все категории</option>
                    <?php foreach (['Смартфоны', 'Ноутбуки', 'Аксессуары', 'Мониторы'] as $cat): ?>
                        <option value="<?= $cat ?>" <?= ($_GET['category'] ?? '') === $cat ? 'selected' : '' ?>><?= $cat ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="min_price" placeholder="Цена от"
                    value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>">
                <input type="number" name="max_price" placeholder="Цена до"
                    value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>">
                <button type="submit" class="btn-search">Применить</button>
                <a href="/" class="btn-reset">Сбросить</a>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Бренд</th>
                    <th>Цена</th>
                    <th>Категория</th>
                    <th>В наличии</th>
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
                            <td><?= (int) $product['quantity'] ?> шт.</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center">Товары не найдены</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>