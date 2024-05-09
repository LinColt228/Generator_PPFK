<?php
  $login = filter_var(trim($_POST['login']),
    FILTER_SANITIEZE_STRING);
    $name = filter_var(trim($_POST['name']),
    FILTER_SANITIEZE_STRING);
    $pass = filter_var(trim($_POST['pass']),
    FILTER_SANITIEZE_STRING);

    $mysql = new mysqli('localhost','root','root','test1base')
    $mysql ->query("INSERT INTO `users`(`login`, `pass`, `name`) 
    VALUES(`$login`,`$pass`,`$name`)
?>


