<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body class="auth-body">
    <div class="auth-card">
        <h1>Вход</h1>
        <?php if (isset($error)): ?>
            <div class="alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="/login" method="POST">
            <div class="form-group">
                <label>Логин</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-primary">Войти</button>
        </form>
        <p class="auth-footer">Нет аккаунта? <a href="/register">Регистрация</a></p>
    </div>
</body>

</html>