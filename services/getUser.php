<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
$userId = $_SESSION["users"];
$query = "SELECT * FROM `users` WHERE id='$userId'";
$sql = mysqli_query($conn,  $query);

$dataUser = mysqli_fetch_assoc($sql);
