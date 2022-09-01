<?php
//Генерируем соль для пароля
    function generateSalt()
    {
        $salt = '';
        $saltLength = 8; 
            
        for($i = 0; $i < $saltLength; $i++) {
            $salt .= chr(mt_rand(33, 126)); 
        }
            
        return $salt;
    }
    
//Проверяем пустоту, наличие пробелов и соответствие критериям
    function chek_error($val,$regular){
        $without_whitespace = '/^\S*$/';
        if (!isset($val) || empty($val)) {
        $val_error = 'Нельзя оставлять поле пустым';
        } elseif (!preg_match($without_whitespace, $val)){
        $val_error = 'Без пробелов, пожалуйста';
        } elseif (!preg_match($regular, $val)) {
        $val_error = 'Не соответствует заданным критериям';
        } else $val_error = ' ';
        return $val_error;
    }
//Сохраняем логин и имя пользователя, который авторизовался    
    function checkCookie() {
        session_start();
    
        if(isset($_COOKIE['login'])){
        $login = $_COOKIE['login'];
    
        $data = file_get_contents('database/db.json');
        $array = json_decode($data,TRUE);
    
        foreach ($array as $key => $value) {
          if ($value['login'] === $login) {
            $_SESSION['auth'] = TRUE;
            $_SESSION['name'] = $value['name'];
            header('Location: profile.php');
            exit();
          }
        }
      }
    }
?>