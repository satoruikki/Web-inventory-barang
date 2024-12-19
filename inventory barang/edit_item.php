<?php
include 'db_connection.php';

$id = $_GET['id']; 

// Validasi ID untuk mencegah kesalahan
if (!is_numeric($id) || $id <= 0) {
    die("ID tidak valid");
}

// Query untuk mendapatkan data barang berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM barang WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$barang = $result->fetch_assoc();

if (!$barang) {
    die("Barang tidak ditemukan");
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $stok_baru = (int) $_POST['stok'];
    $stok_lama = (int) $barang['stok'];

    if ($stok_baru < $stok_lama) {
        $jumlah_keluar = $stok_lama - $stok_baru;

        // Query untuk menambahkan data ke tabel barang_keluar
        $stmt = $conn->prepare("INSERT INTO barang_keluar (barang_id, jumlah, tanggal) VALUES (?, ?, NOW())");
        $stmt->bind_param("ii", $id, $jumlah_keluar);
        $stmt->execute();
    }

    // Query untuk mengupdate data barang
    $stmt = $conn->prepare("UPDATE barang SET nama_barang = ?, stok = ? WHERE id = ?");
    $stmt->bind_param("sii", $nama_barang, $stok_baru, $id);
    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h3 class="text-center">Edit Barang</h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= htmlspecialchars($barang['nama_barang']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="<?= htmlspecialchars($barang['stok']); ?>" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Update</button>
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
