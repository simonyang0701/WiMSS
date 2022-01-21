<?php
include_once __DIR__ . "/../lib/common.php";


/**
 * Generate the store detail list for store managers
 * 
 * 
 * @throws
 * @author Boxuan Li
 * @return resultset
 */

function get_store_detail($username){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT S.Store_number, S.Phone_number, S.Street_address, S.If_showcase
                FROM Store S INNER JOIN Manage M on S.Store_number = M.Store_number
                WHERE M.Username = '" . $username . "';";

    $rows = mysqli_query($conn, $query);
    
    mysqli_close($conn);
    return $rows;
}
?>