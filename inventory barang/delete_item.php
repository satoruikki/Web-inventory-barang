<?php

include 'db_connection.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM barang_keluar WHERE barang_id = $id");
mysqli_query($conn, "DELETE FROM barang_masuk WHERE barang_id = $id");

$query = "DELETE FROM barang WHERE id = $id";

if (mysqli_query($conn, $query)) {
    header('Location: index.php');
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
