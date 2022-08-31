<?php

//Получаем список пользователей из БД
    function getDBarray(){
        $data = file_get_contents('database/db.json');
        $data = json_decode($data,TRUE);
        return $data;
    }

//Добавляем пользователя в БД
    function addUser($password, $name, $login, $email, $data){

        $salt = generateSalt();
        $hashpassword = md5($salt . $password);

        $add_arr = array(
            'name' => $name,
            'login' => $login,
            'email' => $email,
            'password' => $hashpassword,
            'salt' => $salt
            );
        $data[] = $add_arr;
        
        $data = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents('database/db.json', $data);
    }

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