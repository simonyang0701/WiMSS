<?php
include_once __DIR__ . "/../lib/common.php";


/**
 * Generate manufacturer's product report
 * 
 * 
 * @throws
 * @author Yulu Wang
 * @return resultset
 */
function get_manfacture_report(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT Manufacturer_name, COUNT(PID) AS Cnt_product, AVG(Retail_price) AS Avg_price, MIN(Retail_price) 
                AS Min_price, MAX(Retail_price) AS Max_price
                FROM Product
                GROUP BY Manufacturer_name
                ORDER BY Avg_price DESC 
                LIMIT 100;";

    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}

/**
 * Generate manufacturer's detail on selected manufacture
 * 
 * @oaram string $name manufacture name
 * 
 * @throws
 * @author Yulu Wang
 * @return resultset
 */
function get_manfacture_detail($name){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT PF.PID, PF.Product_name, C.Categories, PF.Retail_price
    FROM (SELECT PID, Product_name, Retail_price FROM Product
    WHERE Manufacturer_name = '$name') AS PF
    LEFT JOIN (SELECT PID, GROUP_CONCAT(Category_name) AS Categories
    FROM Assigned_to GROUP BY PID) AS C
    ON PF.PID = C.PID
    ORDER BY PF.Retail_price DESC;";

    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}
?>