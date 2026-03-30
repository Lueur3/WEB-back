<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Добавить новый товар</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <div class="container">
        <h1>Добавление товара</h1>

        <form action="/store" method="POST" class="main-form">
            <div class="form-group">
                <label>Наименование</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Бренд</label>
                <input type="text" name="brand" required>
            </div>
            <div class="form-group">
                <label>Цена (₽)</label>
                <input type="number" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label>Категория</label>
                <select name="category">
                    <option value="Смартфоны">Смартфоны</option>
                    <option value="Ноутбуки">Ноутбуки</option>
                    <option value="Аксессуары">Аксессуары</option>
                    <option value="Мониторы">Мониторы</option>
                </select>
            </div>
            <button type="submit" class="btn-submit">Сохранить в базу данных</button>
        </form>

        <hr>
        <a href="/" class="btn-reset">← Вернуться к списку</a>
    </div>
</body>

</html>