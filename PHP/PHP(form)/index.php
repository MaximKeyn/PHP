<?php
require_once "functions.php";
if (empty($_SESSION['auth']) or $_SESSION['auth'] == FALSE) {
  checkCookie();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="js/signin.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <form method="post" id="signin_form" action="" >
    <input type="text" name="login" placeholder="Введите свой логин" required><br>
    <span id="signin_problem"></span>
    <input type="password" name="password" placeholder="Введите пароль" required><br>
    <input type="submit" id="btn_in" value="Войти" />
    <p>
      У Вас нет аккаунта? - <a href="register.php">Зарегистрируйтесь</a>
    </p>
    <br>
    <div id="result_form"></div>
  </form>
</body>
</html>
