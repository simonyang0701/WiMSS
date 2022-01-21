<?php
include_once __DIR__ . "/../lib/common.php";


/**
 * Generate Outdoor Furniture on Groundhog Day report
 * 
 * 
 * @throws
 * @author Tianyu Yang
 * @return resultset
 */
function get_outdoor_report(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT Year, Total_Year, Avg_Year, Groundhog FROM(
    SELECT YEAR(sells.Date) AS Year, SUM(Quantity) AS Total_Year, SUM(Quantity) / 365 AS Avg_Year
    FROM sells INNER JOIN assigned_to ON sells.PID = assigned_to.PID
    WHERE assigned_to.Category_name = 'Outdoor Furniture'
    GROUP BY Year
    ) AS A INNER JOIN (
    SELECT YEAR(sells.Date) AS Year1, Sum(sells.Quantity) as Groundhog
    FROM sells INNER JOIN assigned_to ON sells.PID = assigned_to.PID
    WHERE assigned_to.Category_name = 'Outdoor Furniture' AND MONTH(sells.Date) = 2 AND DAY(sells.Date) = 2
    GROUP BY Year1
    ) AS B
    ON A.Year = B.Year1
ORDER BY Year;";

    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}
?>