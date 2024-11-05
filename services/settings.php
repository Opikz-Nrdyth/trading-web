<?php
function readSettings()
{
    $filePath = "utils/settings.opz";
    if (!file_exists($filePath)) {
        throw new Exception("File not found: " . $filePath);
    }

    // Baca isi file
    $encryptedData = file_get_contents($filePath);

    // Dekripsi data
    $decodedData = base64_decode($encryptedData);

    // Mengembalikan data sebagai array
    return json_decode($decodedData, true);
}
