<?php
include_once __DIR__ . "/../lib/common.php";


/**
 * Generate store revenue report
 * 
 * 
 * @throws
 * @return resultset
 */
function get_store_revenue_report($state){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT PR.Store_number, PR.Street_address, PR.City_name, PR.Sale_year, ROUND(SUM(PR.Revenue * (1 - ifnull(SSD.Percent_discount, 0) / 100)),2) AS Total_revenue
			FROM
			(SELECT INTER1.Store_number, INTER1.Street_address, INTER1.City_name,INTER1.PID, INTER1.Date, INTER1.Sale_year, INTER1.Quantity * ifnull(INTER1.Price,P1.Retail_price) AS Revenue
			FROM
			(
			SELECT SS.Store_number, SS.Street_address, SS.City_name,SS.PID, SS.Date, SS.Sale_year, SS.Quantity, DS1.Discount_price AS Price
			FROM 
			(SELECT Store.Store_number, Store.Street_address, Store.City_name, Sells.PID, Sells.Date, YEAR(Sells.Date) AS Sale_year, Sells.Quantity
			FROM (Store LEFT JOIN Sells ON Store.Store_number = Sells.Store_number)
			WHERE Store.State = '$state'
			) AS SS
			LEFT JOIN discounted_sale DS1
			ON (SS.PID, SS.Date) = (DS1.PID, DS1.Date)
			) AS INTER1 
			LEFT JOIN Product P1
			ON INTER1.PID = P1.PID) AS PR
			LEFT JOIN
			Special_Saving_Day AS SSD
			ON PR.Date = SSD.Date
			GROUP BY PR.Sale_year, PR.Store_number
			ORDER BY PR.Sale_year, Total_revenue Desc;";

    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}
?>
