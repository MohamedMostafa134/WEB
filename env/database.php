<?php
$count =1 ;
$host ="localhost";
$user ="root";
$pasword ="";
$dbName = "shop";


try {
    $conn = mysqli_connect($host,$user,$pasword,$dbName);
} catch (Exception $e) {
echo $e-> getMessage ();
}