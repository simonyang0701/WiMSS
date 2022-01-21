<?php
include_once __DIR__ . "/main_page.php";

$state = $_POST["state"];
$city = $_POST["city"];

$rows = get_population($state, $city);
if(!mysqli_num_rows($rows) == 0){
    $row = mysqli_fetch_array($rows);
    echo $row[0];
} else {
    echo -1;
}
?>