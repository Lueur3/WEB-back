<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <header class="site-header">
        <div class="container header-flex">
            <nav class="main-nav">
                <a href="/" class="nav-link">Каталог</a>
                <a href="/purchases" class="nav-link">Мои покупки</a>
            </nav>
            <div class="auth-nav">
                <a href="/logout" class="btn-logout">Выход</a>
            </div>
        </div>
    </header>

    <main class="container">
        <h1>Личный кабинет</h1>
        <div class="info-card">
            <p><strong>ФИО:</strong> <?= htmlspecialchars($user['full_name']) ?></p>
            <p><strong>Логин:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>Роль:</strong> <span class="badge"><?= htmlspecialchars($user['role']) ?></span></p>
            <p><strong>Зарегистрирован:</strong> <?= htmlspecialchars($user['created_at']) ?></p>
        </div>
        <br>
        <a href="/" class="btn-primary" style="text-decoration:none">Вернуться к покупкам</a>
    </main>
</body>

</html>