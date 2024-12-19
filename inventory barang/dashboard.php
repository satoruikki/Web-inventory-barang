<?php
include 'db_connection.php';

$query = "SELECT nama_barang, stok FROM barang";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

$nama_barang = [];
$stok_barang = [];

while ($row = mysqli_fetch_assoc($result)) {
    $nama_barang[] = $row['nama_barang'];
    $stok_barang[] = $row['stok'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Stok Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Dashboard Visualisasi Data Stok Barang</h1>

        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h3 class="text-center">Grafik Stok Barang</h3>
            </div>
            <div class="card-body">
                <canvas id="stokChart"></canvas>
            </div>
        </div>
        <br>
        <div class="text-center">
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <script>
        const namaBarang = <?php echo json_encode($nama_barang); ?>;
        const stokBarang = <?php echo json_encode($stok_barang); ?>;

        const ctx = document.getElementById('stokChart').getContext('2d');
        const stokChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: namaBarang, 
                datasets: [{
                    label: 'Jumlah Stok',
                    data: stokBarang, 
                    backgroundColor: 'rgba(75, 192, 192, 0.5)', 
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true 
                    }
                }
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
