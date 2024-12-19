<?php
include 'db_connection.php';

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

$query_masuk = "SELECT b.nama_barang, SUM(bm.jumlah) AS jumlah, bm.tanggal 
                FROM barang_masuk bm 
                JOIN barang b ON bm.barang_id = b.id 
                WHERE MONTH(bm.tanggal) = $bulan AND YEAR(bm.tanggal) = $tahun
                GROUP BY b.nama_barang, bm.tanggal";
$result_masuk = mysqli_query($conn, $query_masuk);

$query_keluar = "SELECT b.nama_barang, SUM(bk.jumlah) AS jumlah, bk.tanggal 
                 FROM barang_keluar bk 
                 JOIN barang b ON bk.barang_id = b.id 
                 WHERE MONTH(bk.tanggal) = $bulan AND YEAR(bk.tanggal) = $tahun
                 GROUP BY b.nama_barang, bk.tanggal";
$result_keluar = mysqli_query($conn, $query_keluar);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inventaris Bulanan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Laporan Inventaris Bulanan</h1>
        
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="bulan" class="form-label">Pilih Bulan</label>
                    <select name="bulan" id="bulan" class="form-select">
                        <?php for ($i = 1; $i <= 12; $i++) : ?>
                        <option value="<?= $i; ?>" <?= $i == $bulan ? 'selected' : ''; ?>>
                            <?= date('F', mktime(0, 0, 0, $i, 1)); ?>
                        </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="tahun" class="form-label">Pilih Tahun</label>
                    <select name="tahun" id="tahun" class="form-select">
                        <?php for ($i = 2020; $i <= date('Y'); $i++) : ?>
                        <option value="<?= $i; ?>" <?= $i == $tahun ? 'selected' : ''; ?>><?= $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-4 align-self-end">
                    <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                </div>
            </div>
        </form>

        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Barang Masuk</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result_masuk)) : ?>
                        <tr>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0">Barang Keluar</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-danger">
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result_keluar)) : ?>
                        <tr>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <a class="btn btn-secondary" href="index.php">Kembali</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
