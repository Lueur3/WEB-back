<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Каталог электроники</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <header class="site-header">
        <div class="container header-flex">
            <nav class="main-nav">
                <a href="/" class="nav-link active">Каталог</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/purchases" class="nav-link">Мои покупки</a>
                <?php endif; ?>
            </nav>
            <div class="auth-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/profile" class="nav-link">👤 <?= htmlspecialchars($_SESSION['username']) ?></a>
                    <a href="/logout" class="btn-logout">Выход</a>
                <?php else: ?>
                    <a href="/login" class="nav-link">Вход</a>
                    <a href="/register" class="btn-reg">Регистрация</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="page-header">
            <h1>Доступные товары</h1>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="/create" class="btn-add">+ Добавить товар</a>
            <?php endif; ?>
        </div>

        <section class="filter-section">
            <form action="/" method="GET" class="filter-form">
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
                <button type="submit" class="btn-apply">Применить</button>
                <a href="/" class="btn-reset">Сбросить</a>
            </form>
        </section>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Бренд</th>
                    <th>Цена</th>
                    <th>Категория</th>
                    <th>Наличие</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($product['name']) ?></strong></td>
                            <td><?= htmlspecialchars($product['brand']) ?></td>
                            <td class="price-text"><?= number_format((float) $product['price'], 2, '.', ' ') ?> ₽</td>
                            <td><span class="badge"><?= htmlspecialchars($product['category']) ?></span></td>
                            <td><?= (int) $product['quantity'] ?> шт.</td>
                            <td>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <?php if ($product['quantity'] > 0): ?>
                                        <a href="/purchases/create?product_id=<?= $product['id'] ?>" class="btn-buy">Купить</a>
                                    <?php else: ?>
                                        <span class="out-of-stock">Нет в наличии</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <small><a href="/login">Войдите для покупки</a></small>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-msg">Товары не найдены</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>

</html>