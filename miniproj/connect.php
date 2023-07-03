<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "donation-database";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName,3307);
if (!$conn) {
    die("Something went wrong". mysqli_connect_error());
}

?>
