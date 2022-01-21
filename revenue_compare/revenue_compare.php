<?php
include_once __DIR__ . "/../lib/common.php";


/**
 * Generate revenue compare report
 * 
 * 
 * @throws
 * @return resultset
 */
function get_revenue_compare_report(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT PD.PID, PD.Product_name, PD.Retail_price, ifnull(PT.Total_number_ever_sold,0) AS Total_number_ever_sold, PD.Total_number_sold_at_discount, ifnull(PT.Total_number_ever_sold,0) - PD.Total_number_sold_at_discount AS Total_number_sold_at_retail_price, PD.Actual_revenue, PD.Predicted_revenue, PD.Revenue_difference
		FROM
		(
		(SELECT P.PID, P.Product_name, P.Retail_price, SUM(ifnull(D.Quantity,0) * ifnull(D.Discount_price,0)) AS Actual_revenue, SUM(ifnull(D.Quantity,0) * 0.75 * P.Retail_price) AS Predicted_revenue, SUM(ifnull(D.Quantity,0)) AS Total_number_sold_at_discount, SUM(ifnull(D.Quantity,0) * ifnull(D.Discount_price,0)) - SUM(ifnull(D.Quantity,0) * 0.75 * P.Retail_price) AS Revenue_difference
		FROM
		(SELECT Product.PID, Product.Retail_price, Product.Product_name
		FROM (Product INNER JOIN Assigned_to ON Product.PID = Assigned_to.PID)
		WHERE Category_name = 'Couches and sofas'
		) AS P
		LEFT JOIN
		(SELECT Sells.PID, Sells.Date, Sells.Quantity, Discounted_sale.Discount_price
		FROM (Sells INNER JOIN Discounted_sale ON Sells.PID = Discounted_sale.PID AND Sells.Date = Discounted_sale.Date )
		) AS D
		ON P.PID = D.PID
		GROUP BY P.PID
		) AS PD
		LEFT JOIN
		(SELECT P2.PID, SUM(Sells.Quantity) AS Total_number_ever_sold
		FROM (
		(SELECT Product.PID, Product.Retail_price, Product.Product_name
		FROM (Product INNER JOIN Assigned_to ON Product.PID = Assigned_to.PID)
		WHERE Category_name = 'Couches and sofas'
		) AS P2 
		INNER JOIN Sells 
		ON P2.PID = Sells.PID)
		GROUP BY P2.PID
		)AS PT
		ON PD.PID = PT.PID
		)
		WHERE PD.Revenue_difference > 5000 OR PD.Revenue_difference < -5000
		ORDER BY PD.Revenue_difference DESC;";

    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}
?>