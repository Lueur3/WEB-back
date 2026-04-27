<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Добавление товара</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <div class="container form-page">
        <h1>Новый товар</h1>
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
                <label>Количество</label>
                <input type="number" name="quantity" required min="0">
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
            <button type="submit" class="btn-primary">Сохранить товар</button>
            <a href="/" class="btn-link">Назад в каталог</a>
        </form>
    </div>
</body>

</html>