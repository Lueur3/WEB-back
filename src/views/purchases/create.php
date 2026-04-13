<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Оформить продажу</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <div class="container">
        <h1>Оформление продажи</h1>
        <form action="/purchases/store" method="POST" class="main-form">
            <div class="form-group">
                <label>Выберите клиента</label>
                <select name="client_id" required>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?= $client['id'] ?>"><?= htmlspecialchars($client['full_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Выберите товар</label>
                <select name="product_id" required>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $product['id'] ?>">
                            <?= htmlspecialchars($product['name']) ?> (Доступно: <?= $product['quantity'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Количество</label>
                <input type="number" name="count" required min="1">
            </div>
            <button type="submit" class="btn-submit" style="background-color: #10b981;">Подтвердить покупку</button>
        </form>
        <br>
        <a href="/purchases">Отмена</a>
    </div>
</body>

</html>