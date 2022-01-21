<?php
include_once __DIR__ . "/main_page.php";

$state = $_POST["state"];
$city = $_POST["city"];
$new_population = $_POST["population"];

if(update_population($state, $city, $new_population)){
    echo 1;
}else{
    echo 0;
}
?>