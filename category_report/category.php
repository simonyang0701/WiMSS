<?php
include_once __DIR__ . "/../lib/common.php";


/**
 * Generate category report
 * 
 * 
 * @throws
 * @return resultset
 */
function get_category_report(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT C.Category_name, COUNT(C.PID) AS Cnt, ifnull(MIN(P.Retail_price),'N/A') AS MinP, ifnull(MAX(P.Retail_price),'N/A') AS MaxP, ifnull(AVG(P.Retail_price),'N/A') AS AvgP
		FROM(
		SELECT Category.Category_name, Assigned_to.PID FROM
		Category LEFT JOIN Assigned_to
		ON Category.Category_name = Assigned_to.Category_name) AS C
		LEFT JOIN Product AS P
		ON C.PID = P.PID
		GROUP BY C.Category_name
		ORDER BY C.Category_name;";

    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}
?>