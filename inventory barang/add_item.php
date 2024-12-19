<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];

    $query = "INSERT INTO barang (nama_barang, stok) VALUES ('$nama_barang', '$stok')";

    if (mysqli_query($conn, $query)) {
        $barang_id = mysqli_insert_id($conn);

        $tanggal_sekarang = date('Y-m-d'); 
        $query_masuk = "INSERT INTO barang_masuk (barang_id, jumlah, tanggal) 
                    VALUES ('$barang_id', '$stok', '$tanggal_sekarang')";
        mysqli_query($conn, $query_masuk);

        echo "<script>
        alert('Barang berhasil ditambahkan');
        window.location.href = 'index.php';
    </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h3 class="text-center">Tambah Barang</h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" required
                            placeholder="Masukkan nama barang">
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" required
                            placeholder="Masukkan jumlah stok">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>