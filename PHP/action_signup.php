<?php
session_start();
require "functions.php";
require_once 'Json.class.php'; 
$db = new Json(); 

$login = $_POST['login'];  
$password = $_POST['password']; 
$password_confirm = $_POST['password_confirm']; 
$email = $_POST['email']; 
$name = $_POST['name'];

//password [валидация : минимум 6 символов , обязательно должны состоять из цифр и букв]
$regular_password = '/(?=.*[0-9])(?=.*[a-zA-Zа-яА-Я])[0-9a-zA-Zа-яА-Я]{6,}/';
//name [валидация : 2 символа , только буквы]
$regular_name = '/^[а-яА-ЯёЁa-zA-Z]{2,}$/';
//login [валидация : минимум 6 символов ]
$regular_login = '/^[а-яА-ЯёЁa-zA-Z0-9]{6,}$/';

//Валидация полей

$name_error = chek_error($name,$regular_name);

$login_error = chek_error($login,$regular_login);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $email_error = 'Не соответствует нормам почты';
} else $email_error = ' ';

$password_error = chek_error($password,$regular_password);
  
if (!isset($password_confirm) || empty($password_confirm)) {
  $password_confirm_error = 'Введите подтверждение пароля';
} elseif (isset($password) && ($password != $password_confirm)) {
  $password_confirm_error = 'Пароли не совпадают';
} else $password_confirm_error = ' ';


//Подключаем БД
$db = new Json(); 
$data = $db->getRows(); 

// Проверяем существет ли логин или почта
if(!empty($data)&&!empty($login)&&!empty($email))
{
  foreach ($data as $key => $value) {
    if ($value['login'] === $login) {
      $login_error = 'Данный логин уже используется';
    }
  }
  foreach ($data as $key => $value) {
    if ($value['email'] === $email) {
      $email_error = 'Данный email уже используется';
    }
  }
}

//Если нет ошибок, довавляем пользователя в БД
if($name_error == ' ' && $login_error == ' ' && $email_error == ' ' && $password_error == ' ' && $password_confirm_error == ' '){
  $salt = generateSalt();
  $hashpassword = md5($salt . $password);
  $userData = array( 
    'name' => $name, 
    'email' => $email, 
    'login' => $login, 
    'password' => $hashpassword ,
    'salt' => $salt
); 
  $insert = $db->insert($userData); 
  $result = 'Пользователь был успешно добавлен';
  $errors = ['name' => $name_error,
  'login' => $login_error , 
  'email' => $email_error , 
  'password' => $password_error , 
  'password_confirm' => $password_confirm_error,
  'result' => $result
  ];
}else {$result = 'Мы подождем...';
  $errors = ['name' => $name_error,
  'login' => $login_error , 
  'email' => $email_error , 
  'password' => $password_error , 
  'password_confirm' => $password_confirm_error,
  'result' => $result
  ];
}

echo json_encode($errors);
     
?>