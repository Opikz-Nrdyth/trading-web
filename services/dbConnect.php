<?php
// $servername = "localhost";
// $username = "sql_api_ventoro_";
// $password = "5506bef4a6acb";
// $database = "sql_api_ventoro_";

$servername = "localhost";
$username = "root";
$password = "";
$database = "tradergo";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
