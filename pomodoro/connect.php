<?php
    $user = 'root';
    $pass = '';
    $db = 'pomodoro';

    
    $mysqli = new mysqli('localhost', $user, $pass, $db) or die("DEAD" .mysqli_connect_error());

?>