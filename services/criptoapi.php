<?php
require_once("./dbConnect.php");

if (isset($_GET["coins"])) {
    $query = "SELECT * FROM `crypto_coins`";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Ambil semua data sebagai array asosiatif
        $coins = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // Kembalikan data dalam format JSON
        echo json_encode($coins);
    } else {
        // Jika terjadi kesalahan dalam query, kembalikan pesan error
        echo json_encode(["error" => "Query failed: " . mysqli_error($conn)]);
    }
}
