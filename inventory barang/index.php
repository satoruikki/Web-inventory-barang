<?php

include 'db_connection.php';

$sql = "SELECT * FROM barang";
$result = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Inventory</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">

        <div class="bg-dark text-white p-3" style="width: 250px; height: 100vh;">
            <h4 class="text-center mb-4">Menu</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="add_item.php" class="nav-link text-white">Tambah Barang</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="dashboard.php" class="nav-link text-white">Visualisasi Stok</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="laporan.php" class="nav-link text-white">Laporan Bulanan</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="container-fluid p-4">
            <h1 class="text-center mb-4">Dashboard Inventory Barang</h1>

            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>ID</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr <?php if ($row['stok'] < 10)
                                    echo 'class="bg-warning"'; ?>>
                                    <td class="text-center"><?= $row['id']; ?></td>
                                    <td><?= $row['nama_barang']; ?></td>
                                    <td class="text-center">
                                        <?= $row['stok']; ?>
                                        <?php if ($row['stok'] < 10): ?>
                                            <div class="text-danger" style="font-size: 12px; margin-top: 5px;">
                                                Stok Hampir Habis!
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="edit_item.php?id=<?= $row['id']; ?>"
                                            class="btn btn-success btn-sm">Edit</a>
                                        <a href="delete_item.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Inventory</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" style="width: 250px; height: 100vh;">
            <h4 class="text-center mb-4">Menu</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="add_item.php" class="nav-link text-white">Tambah Barang</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="dashboard.php" class="nav-link text-white">Visualisasi Stok</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="laporan.php" class="nav-link text-white">Laporan Bulanan</a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link text-white">Dashboard</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="container-fluid p-4">
            <h1 class="text-center mb-4">Dashboard Inventory Barang</h1>
            <!-- Tambahkan konten utama halaman index.php di sini -->
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>ID</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr <?php if ($row['stok'] < 10)
                                    echo 'class="bg-warning"'; ?>>
                                    <td class="text-center"><?= $row['id']; ?></td>
                                    <td><?= $row['nama_barang']; ?></td>
                                    <td class="text-center">
                                        <?= $row['stok']; ?>
                                        <?php if ($row['stok'] < 10): ?>
                                            <div class="text-danger" style="font-size: 12px; margin-top: 5px;">
                                                Stok Hampir Habis!
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="edit_item.php?id=<?= $row['id']; ?>"
                                            class="btn btn-success btn-sm">Edit</a>
                                        <a href="delete_item.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>