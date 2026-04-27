<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body class="auth-body">
    <div class="auth-card">
        <h1>Регистрация</h1>
        <?php if (isset($error)): ?>
            <div class="alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="/register" method="POST">
            <div class="form-group">
                <label>ФИО</label>
                <input type="text" name="full_name" required>
            </div>
            <div class="form-group">
                <label>Логин</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-primary">Создать аккаунт</button>
        </form>
        <p class="auth-footer">Уже есть аккаунт? <a href="/login">Войти</a></p>
    </div>
</body>

</html>