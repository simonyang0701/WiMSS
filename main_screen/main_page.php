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

function get_count_store(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT COUNT(Store_number) FROM Store;";

    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}

function get_count_showcase(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT COUNT(Store_number) FROM Store WHERE If_showcase = 1;";

    $rows = mysqli_query($conn, $query);
    
    mysqli_close($conn);
    return $rows;
}

function get_count_manufacturer(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT COUNT(Manufacturer_name) FROM Manufacturer;";

    $rows = mysqli_query($conn, $query);
    
    mysqli_close($conn);
    return $rows;
}

function get_count_product(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT COUNT(PID) FROM Product;";

    $rows = mysqli_query($conn, $query);
    
    mysqli_close($conn);
    return $rows;
}

function get_count_ssd(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT COUNT(Date) FROM Special_Saving_Day;";

    $rows = mysqli_query($conn, $query);
    
    mysqli_close($conn);
    return $rows;
}

function get_count_storemanaged($username){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT COUNT(Store_number) FROM Manage WHERE Username = '" . $username . "';";

    $rows = mysqli_query($conn, $query);
    
    mysqli_close($conn);
    return $rows;
}

/**
 * Get population of a given state and city pair
 * 
 * @oaram string $state state
 * @oaram string $city city
 * 
 * @throws
 * @author Yulu Wang
 * @return resultset
 */
function get_population($state, $city){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT Population
                FROM City
                WHERE City_name = '$city' AND State = '$state';";

    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}

/**
 * Update population of a given state and city pair
 * 
 * @oaram string $state state
 * @oaram string $city city
 * @param string $population population
 * 
 * @throws
 * @author Yulu Wang
 * @return 
 */
function update_population($state, $city, $new_population){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "UPDATE City
    SET Population = '$new_population'
    WHERE City_name = '$city' AND State = '$state';";

    if(!mysqli_query($conn, $query)){
        return false;
    }else{
        return true;
    }
}
?>