<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Магазин электроники</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <div class="container">
        <h1>Управление товарами</h1>

        <div class="list-header">
            <a href="/create" class="btn-search" style="text-decoration: none;">+ Добавить товар</a>

            <form action="/" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Поиск..." value="<?= htmlspecialchars($search ?? '') ?>">
                <button type="submit" class="btn-search">Найти</button>
                <?php if (!empty($search)): ?>
                    <a href="/" class="btn-reset">Сброс</a>
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
                        <td colspan="4" style="text-align:center">Товары не найдены</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>