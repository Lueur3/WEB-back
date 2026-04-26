<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>История покупок</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <div class="container">
        <nav>
            <a href="/">Товары</a> |
            <a href="/purchases">История покупок</a>
        </nav>
        <h1>Журнал продаж</h1>
        <a href="/purchases/create" class="btn-search"
            style="text-decoration: none; background-color: #10b981;">Оформить продажу</a>

        <table style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Клиент</th>
                    <th>Товар</th>
                    <th>Кол-во</th>
                    <th>Сумма</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($purchases)): ?>
                    <?php foreach ($purchases as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['purchase_date']) ?></td>
                            <td><?= htmlspecialchars($p['client_name']) ?></td>
                            <td><?= htmlspecialchars($p['product_name']) ?></td>
                            <td><?= (int) $p['count'] ?></td>
                            <td><?= number_format((float) $p['total_price'], 2, '.', ' ') ?> ₽</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center">Продаж пока не было</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>