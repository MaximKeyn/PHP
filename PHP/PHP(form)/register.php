<?php
require_once "functions.php";
if (empty($_SESSION['auth']) or $_SESSION['auth'] == FALSE) {
  checkCookie();
}
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="js/signup.js"></script>
</head>
<body>
  </form>
  <form method="post" id="signup_form" action="" >
    <label>Имя</label>
    <span id="name"></span>
    <input type="text" name="name" placeholder="Введите имя(2 буквы)" required> 

    <label>Логин</label>
    <span id="login"></span>
    <input type="text" name="login" placeholder="Введите логин (6 символов, буквы и цифры)" required>

    <label>E-mail</label>
    <span id="email"></span>
    <input type="email" name="email" placeholder="Введите адрес своей почты" required>

    <label>Пароль</label>
    <span id="password"></span>
    <input type="password" name="password" placeholder="Введите пароль" required>

    <label>Подтверждение пароля</label>
    <span id="password_confirm"></span>
    <input type="password" name="password_confirm" placeholder="Подтвердите пароль" required>

    <input type="button" id="btn_up" value="Зарегистрироваться" />
    <p>
        У Вас уже есть аккаунт? - <a href="index.php">Войти</a>
    </p>
    <br>
    <div id="result_form"></div>
  </form>
</body>
</html>
