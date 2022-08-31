<?php
session_start();
if (empty($_SESSION['auth']) or $_SESSION['auth'] == FALSE) {
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Профиль</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h4>Привет, <?php echo $_SESSION['name']; ?> ! <a href="action_logout.php">Выйти</a></h4>
</body>
</html>
