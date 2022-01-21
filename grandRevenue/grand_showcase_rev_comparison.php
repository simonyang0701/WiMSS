<?php
include_once __DIR__ . "/../lib/common.php";

/**
 * Generate Grand Showcase Store Revenue Comparison report
 * 
 * 
 * @throws
 * @author Xingyu Ren
 * @return Comparison table
 */

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


function get_count_regular(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT COUNT(Store_number) FROM Store WHERE If_showcase = 0;";

    $rows = mysqli_query($conn, $query);
    
    mysqli_close($conn);
    return $rows;
}


function get_Grand_revenue_comparison(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT GrandYR.Year, GminR, GavgR, GmaxR, GtotalR, RminR, RavgR, RmaxR, RtotalR
			FROM

			(SELECT Year, ROUND(min(Revenue),2) AS GminR, ROUND(max(Revenue),2) AS GmaxR, ROUND(sum(Revenue),2) AS GtotalR, ROUND(avg(Revenue),2) AS GavgR
			FROM
			(SELECT INTER2.Year, INTER2.Store_number, SUM((INTER2.Quantity * INTER2.Price *(1 - INTER2.Percent_discount/100)))AS Revenue
			FROM

			(SELECT GrandQ.Store_number, YEAR(INTER1.Date) AS YEAR, INTER1.Quantity, IFNULL(INTER1.Price, P1.Retail_price) AS Price, IFNULL(SSD.Percent_discount, 0) AS Percent_discount
			FROM
			(
			(
			(
			(SELECT S.Store_number, S.PID, S.Date, S.Quantity, DS.Discount_price AS Price
			FROM
			Sells S
			LEFT JOIN Discounted_Sale DS
			ON (S.PID,S.Date) = (DS.PID,DS.Date)
			)
			AS INTER1
			LEFT JOIN Product P1
			ON INTER1.PID = P1.PID)
			LEFT JOIN Special_Saving_Day SSD 
			ON INTER1.Date = SSD.Date) 

			INNER JOIN 
			(SELECT Store.Store_number, Store.If_showcase
			FROM Store
			WHERE If_showcase = 1) AS GrandQ
			ON INTER1.Store_number = GrandQ.Store_number)
			) AS INTER2
			GROUP BY Year, Store_number
			) AS INTER3
			GROUP BY Year)
			AS GrandYR

			INNER JOIN

			(SELECT Year, ROUND(min(Revenue),2) AS RminR, ROUND(max(Revenue),2) AS RmaxR, ROUND(sum(Revenue),2) AS RtotalR, ROUND(avg(Revenue),2) AS RavgR
			FROM
			(SELECT INTER2.Year, INTER2.Store_number, SUM((INTER2.Quantity * INTER2.Price *(1 - INTER2.Percent_discount/100)))AS Revenue
			FROM

			(SELECT RegularQ.Store_number, YEAR(INTER1.Date) AS YEAR, INTER1.Quantity, IFNULL(INTER1.Price, P1.Retail_price) AS Price, IFNULL(SSD.Percent_discount, 0) AS Percent_discount
			FROM
			(
			(
			(
			(SELECT S.Store_number, S.PID, S.Date, S.Quantity, DS.Discount_price AS Price
			FROM
			Sells S
			LEFT JOIN Discounted_Sale DS
			ON (S.PID,S.Date) = (DS.PID,DS.Date)
			)
			AS INTER1
			LEFT JOIN Product P1
			ON INTER1.PID = P1.PID)
			LEFT JOIN Special_Saving_Day SSD 
			ON INTER1.Date = SSD.Date) 

			INNER JOIN 
			(SELECT Store.Store_number, Store.If_showcase
			FROM Store
			WHERE If_showcase = 0) AS RegularQ
			ON INTER1.Store_number = RegularQ.Store_number)
			) AS INTER2
			GROUP BY Year, Store_number
			) AS INTER3
			GROUP BY Year)
			AS RegularYR
			ON GrandYR.Year = RegularYR.Year
			ORDER BY GrandYR.Year ASC;";

    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}
?>