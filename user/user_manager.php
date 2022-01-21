<?php
include_once __DIR__ . "/../lib/common.php";

/**
 * Check against User table with username and userpass
 * 
 * @oaram string $username username
 * @oaram string $userpass user password
 * 
 * @author Yulu Wang
 * @return boolean
 */
function sign_in($username, $userpass){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }
    $query = "SELECT Username from User WHERE Username = '$username' AND Password = '$userpass'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        mysqli_close($conn);
        return true;
    }else{
        mysqli_close($conn);
        return false;
    }
}

/**
 * Check if a given username is a Marketing user
 * 
 * @oaram string $username username
 * 
 * @author Yulu Wang
 * @return boolean
 */
function is_marketing($username){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }
    $query = "SELECT Username from Marketing WHERE Username = '$username'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        mysqli_close($conn);
        return true;
    }else{
        mysqli_close($conn);
        return false;
    }
}

/**
 * Check is a given User is a corporate user
 * 
 * @oaram string $username username
 * 
 * @author Yulu Wang
 * @return boolean
 */
function is_corporate($username){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }
    $query = "SELECT Username from Read_Only_Corporate WHERE Username = '$username'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        mysqli_close($conn);
        return true;
    }else{
        mysqli_close($conn);
        return false;
    }
}
?>