<?php
include_once __DIR__ . "/../lib/common.php";

/**
 * Generate Grand Showcase Store Category Comparison report
 * 
 * 
 * @throws
 * @author Xingyu Ren
 * @return Comparison table
 */

function get_Grand_category_comparison(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "SELECT  GrandQ.Category_name, Grand_Showcase_Qty, Regular_Qty,  Grand_Showcase_Qty - Regular_Qty as Q_difference
            FROM
            (SELECT Asg.Category_name, SUM(Quantity) AS Grand_Showcase_Qty 
            FROM
            (SELECT Store_number FROM Store
            WHERE Store.If_showcase = 1) AS GrandS
            INNER JOIN Sells 
            ON GrandS.Store_number = Sells.Store_number
            INNER JOIN Assigned_to Asg
            ON Sells.PID = Asg.PID
            GROUP BY Asg.Category_name) AS GrandQ   

            INNER JOIN
            (SELECT Asg.Category_name, SUM(Quantity) AS Regular_Qty 
            FROM
            (SELECT Store_number FROM Store
            WHERE Store.If_showcase = 0) AS RegularS
            INNER JOIN Sells 
            ON RegularS.Store_number = Sells.Store_number
            INNER JOIN Assigned_to Asg
            ON Sells.PID = Asg.PID
            GROUP BY Asg.Category_name) AS RegularQ

            ON GrandQ.Category_name = RegularQ.Category_name
            ORDER BY Q_difference DESC;";

    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}



function get_product_from_category($category){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$conn){
        die("Could not connect to the mysql database: " . mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_SCHEMA);
    if(!$db_selected){
        die("Selected schema is not available: " . mysqli_error($conn));
    }

    $query = "WITH Product_CTE 
            (Product_ID, Product_name, Grand_Showcase_Qty, Regular_Qty, Q_difference)
            AS(
            SELECT GrandQ.PID AS Product_ID, GrandQ.Product_name, GrandQ.Grand_Showcase_Qty, RegularQ.Regular_Qty, GrandQ.Grand_Showcase_Qty - RegularQ.Regular_Qty as Q_difference
            FROM
            (SELECT P.PID, P.Product_name, SUM(ifnull(Sells.Quantity, 0)) AS Grand_Showcase_Qty 
            FROM Product P
            INNER JOIN 
            (SELECT * FROM Assigned_to 
            WHERE Category_name = '$category') AS Assg
            ON P.PID = Assg.PID
            LEFT JOIN Sells
            ON P.PID = Sells.PID
            INNER JOIN
            (SELECT * FROM Store
            WHERE Store.If_showcase = 1) AS GrandS
            ON GrandS.Store_number = Sells.Store_number
            GROUP BY P.PID) AS GrandQ

            INNER JOIN

            (SELECT P.PID, P.Product_name, SUM(ifnull(Sells.Quantity, 0)) AS Regular_Qty 
            FROM Product P
            INNER JOIN 
            (SELECT * FROM Assigned_to
            WHERE Category_name = '$category') AS Assg
            ON P.PID = Assg.PID
            LEFT JOIN Sells
            ON P.PID = Sells.PID
            INNER JOIN
            (SELECT * FROM Store
            WHERE Store.If_showcase = 0) AS RegularS
            ON RegularS.Store_number = Sells.Store_number
            GROUP BY P.PID) AS RegularQ
            ON GrandQ.PID = RegularQ.PID)


            (SELECT * FROM Product_CTE
            ORDER BY Q_difference DESC, Product_ID ASC LIMIT 5)
            UNION
            (SELECT * FROM Product_CTE
            ORDER BY Q_difference ASC, Product_ID ASC LIMIT 5)
            ORDER BY Q_difference DESC, Product_ID ASC;";

    $rows = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $rows;
}

?>
