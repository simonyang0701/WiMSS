<?php
include_once __DIR__ . "/../lib/common.php";


/**
 * Generate State with Highest Volume for each Category report
 * 
 * 
 * @throws
 * @author Tianyu Yang
 * @return resultset
 */
function get_state_report($year, $month){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

//    $query = "SELECT Category_name, State, MAX(Quantity_sum) AS Quantity FROM (
//	SELECT assigned_to.Category_name, store.State, SUM(sells.Quantity) AS Quantity_sum
//    FROM sells INNER JOIN store on sells.Store_number = store.Store_number INNER JOIN assigned_to ON sells.PID = assigned_to.PID
//    WHERE YEAR(sells.Date) = 2008 AND MONTH(sells.Date) = 12
//    GROUP BY assigned_to.Category_name, store.State
//) AS A
//GROUP BY Category_name";

    $query = "SELECT Category_name AS 'Category Name', State, Total_sold AS 'Number of Sold Units' FROM
(SELECT ROW_NUMBER() OVER (PARTITION BY Category_name ORDER BY Total_sold DESC) as RowNum, Category_name, State, Total_sold
FROM
(SELECT INTER1.Category_name, INTER1.State, SUM(INTER1.Quantity) AS Total_sold
FROM
(SELECT Category_name, State, Quantity
FROM 
((sells SE1 LEFT JOIN assigned_to A1
ON SE1.PID = A1.PID)
LEFT JOIN 
store ST1 ON SE1.Store_number = ST1.Store_number
)
WHERE MONTH(SE1.Date) = " . $month . " and YEAR(SE1.Date) = " . $year . ") AS INTER1
GROUP BY INTER1.Category_name, INTER1.State) AS INTER2
) AS INTER3
WHERE RowNum = 1;";

    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}
?>