<?php
include_once __DIR__ . "/../lib/common.php";


/**
 * Generate Revenue by Population report
 * 
 * 
 * @throws
 * @author Tianyu Yang
 * @return resultset
 */
function get_revenuePopulation_report(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT city_size, YEAR(CS.Date) AS Year, 
	SUM(CASE WHEN sell_price IS NOT NULL
    	THEN sell_price * Quantity
        ELSE Retail_price * Quantity
    END) AS Revenue
FROM
(SELECT sells.PID, sells.Quantity, A.city_size, sells.Date, product.Retail_price FROM
sells INNER JOIN
(SELECT store.Store_number,
    CASE WHEN city.Population < 3700000
        THEN 'SMALL'
        WHEN city.Population >= 3700000 AND city.Population < 6700000
        THEN 'MEDIUM'
        WHEN city.Population >= 6700000 AND city.Population < 9000000
        THEN 'LARGE'
         WHEN city.Population >= 9000000
        THEN 'EXTRA LARGE'
    END AS city_size
FROM store INNER JOIN city ON store.City_name = city.City_name) AS A ON sells.Store_number = A.Store_number
INNER JOIN product ON sells.PID = product.PID) AS CS
LEFT JOIN
(SELECT TP.PID, discounted_sale.Date,
 	ROUND(CASE WHEN special_saving_day.Percent_discount IS NOT NULL AND Discount_price IS NOT NULL THEN Discount_price * (100-Percent_discount)/100 
 		WHEN special_saving_day.Percent_discount IS NULL AND Discount_price IS NOT NULL THEN Discount_price
 	END) AS sell_price From
   (SELECT DISTINCT sells.PID, product.Retail_price 
    FROM sells INNER JOIN product ON sells.PID = product.PID ) AS TP 
    	JOIN discounted_sale ON TP.PID = discounted_sale.PID 
     	LEFT JOIN special_saving_day ON discounted_sale.Date = special_saving_day.Date) as SP
ON CS.PID = SP.PID AND CS.Date = SP.Date
GROUP BY city_size, Year
ORDER BY Year, city_size DESC";


    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}
?>