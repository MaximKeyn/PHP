<?php
session_start();
require "functions.php";

if (isset($_POST["login"]) && isset($_POST["password"]) ) {

  $login = $_POST['login'];
  $password = $_POST['password'];

  $data = getDBarray();

  // Проверяем логин и пароль в БД
  foreach ($data as $key => $value) {
    if ($value['login'] === $login) {
    $salt = $value['salt']; 
		$hash = $value['password'];
		
		$pass = md5($salt . $_POST["password"]); // соленый пароль от юзера
		
		if ($pass === $hash) {

      $_SESSION['auth'] = TRUE;
      $_SESSION['name'] = $value['name'];

      setcookie('login', $value['login'], time()+3600);

      $result = array('status' => 'ok');
      echo json_encode($result);
      exit();
      }
    $result = array('status' => 'pass_problem');
    echo json_encode($result); 
    exit();
    }
    }
    $result = array('status' => 'login_problem');
    echo json_encode($result);
}

?>
