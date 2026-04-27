<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Мои покупки</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <header class="site-header">
        <div class="container header-flex">
            <nav class="main-nav">
                <a href="/" class="nav-link">Каталог</a>
                <a href="/purchases" class="nav-link active">Мои покупки</a>
            </nav>
            <div class="auth-nav">
                <a href="/profile" class="nav-link">👤 <?= htmlspecialchars($_SESSION['username']) ?></a>
                <a href="/logout" class="btn-logout">Выход</a>
            </div>
        </div>
    </header>

    <main class="container">
        <h1><?= $_SESSION['role'] === 'admin' ? 'Все продажи системы' : 'Мои покупки' ?></h1>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Покупатель</th>
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
                            <td><?= (int) $p['count'] ?> шт.</td>
                            <td class="price-text"><?= number_format((float) $p['total_price'], 2, '.', ' ') ?> ₽</td>
                        </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="empty-msg">История пуста</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>

</html>