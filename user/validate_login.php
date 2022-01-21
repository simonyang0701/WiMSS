<?php
include "user_manager.php";

$username = $_POST["username"];
$userpass = $_POST["userpass"];

if(sign_in($username, $userpass)){
    session_start();
    if(is_marketing($username)){
        $_SESSION['sess_user_role'] = "Marketing";
    }else if(is_corporate($username)){
        $_SESSION['sess_user_role'] = "Corporate";
    }else{
        $_SESSION['sess_user_role'] = "Manager";
    }
    $_SESSION['sess_username'] = $username;
    header("location: ../index.php");
} else {
    echo '<script type="text/javascript"> alert("Incorrect username or password. Please try again."); window.location.href="../login.html";</script>';
}