<?php
session_start();
setcookie('login', '', time()-3600);
session_destroy();
header('Location: index.php');
?>
