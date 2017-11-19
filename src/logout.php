<?php
session_start();
require 'db.php';

if ($_SESSION['active'] and (isset($_SESSION['username']))){
    //Clean session
    $_SESSION['active'] = false;
    setcookie("uid", '', time() - 6000, "/");

    //update log table
    $escapeUsername = $mysqli->real_escape_string($_SESSION['username']);
    echo $mysqli->query("insert into information (username , action) 
								values ('$escapeUsername','LOGOUT')");
    unset($_SESSION['username']);
}
header("location: http://" . $_SERVER['HTTP_HOST'] . "/mono/src/index.php");
?>