<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Добавить товар</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <div class="container">
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
                <label>Цена</label>
                <input type="number" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label>Количество на складе</label>
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
            <button type="submit" class="btn-submit">Сохранить</button>
        </form>
        <br>
        <a href="/">Назад</a>
    </div>
</body>

</html>