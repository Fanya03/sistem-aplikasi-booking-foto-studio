<?php
$koneksi = new mysqli("localhost", "root", "", "snapora_studio");
$query = $koneksi->query("SELECT tanggal, jam FROM booking");

$booked = [];

while ($row = $query->fetch_assoc()) {
    $date = $row['tanggal'];
    $jam = $row['jam'];
    if (!isset($booked[$date])) {
        $booked[$date] = [];
    }
    $booked[$date][] = $jam;
}

header('Content-Type: application/json');
echo json_encode($booked);
?>
