<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Оформление покупки</title>
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
        <h1>Подтверждение покупки</h1>

        <div class="info-card">
            <p>Товар: <strong><?= htmlspecialchars($product['name']) ?></strong></p>
            <p>Цена: <strong><?= number_format((float) $product['price'], 2, '.', ' ') ?> ₽</strong></p>
            <p>Остаток: <strong><?= (int) $product['quantity'] ?> шт.</strong></p>
        </div>

        <div class="main-form-container">
            <form action="/purchases/store" method="POST" class="main-form">
                <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">

                <div class="form-group">
                    <label>Введите количество</label>
                    <input type="number" name="count" min="1" max="<?= (int) $product['quantity'] ?>" value="1"
                        required>
                </div>

                <div class="form-actions"
                    style="margin-top: 20px; display: flex; flex-direction: column; gap: 15px; align-items: center;">
                    <button type="submit" class="btn-buy" style="width: 100%; padding: 12px; font-size: 1rem;">
                        Оформить заказ
                    </button>
                    <a href="/" class="btn-reset">Отмена</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>