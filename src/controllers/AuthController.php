<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }


    public function loginForm(): void
    {
        require __DIR__ . '/../views/auth/login.php';
    }


    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->getByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header('Location: /profile');
                exit();
            } else {
                $error = "Неверный логин или пароль";
                require __DIR__ . '/../views/auth/login.php';
            }
        }
    }


    public function registerForm(): void
    {
        require __DIR__ . '/../views/auth/register.php';
    }


    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $fullName = $_POST['full_name'] ?? '';
            $role = 'user';

            if (!empty($username) && !empty($password) && !empty($fullName)) {
                try {
                    if ($this->userModel->create($username, $password, $fullName, $role)) {
                        header('Location: /login');
                        exit();
                    }
                } catch (PDOException $e) {
                    if ($e->getCode() == 23000) {
                        $error = "Этот логин уже занят. Выберите другой.";
                    } else {
                        $error = "Системная ошибка при регистрации.";
                    }
                    require __DIR__ . '/../views/auth/register.php';
                    return;
                }
            } else {
                $error = "Все поля обязательны для заполнения.";
                require __DIR__ . '/../views/auth/register.php';
                return;
            }
        }
        require __DIR__ . '/../views/auth/register.php';
    }


    public function logout(): void
    {
        session_destroy();
        header('Location: /login');
        exit();
    }


    public function profile(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $user = $this->userModel->getById($_SESSION['user_id']);
        require __DIR__ . '/../views/auth/profile.php';
    }
}