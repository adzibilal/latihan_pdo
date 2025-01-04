<?php
require_once "config/database.php";
require_once "models/Barang.php";

$database = new Database();
$db = $database->getConnection();
$barang = new Barang($db);

if (isset($_GET['id'])) {
    $barang->id = $_GET['id'];
    $barang->readOne();
}

if ($_POST) {
    $barang->id = $_POST['id'];
    $barang->nama = $_POST['nama'];
    $barang->harga = $_POST['harga'];
    $barang->stok = $_POST['stok'];

    if ($barang->update()) {
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Edit Barang</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?= $barang->id ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $barang->nama ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?= $barang->harga ?>" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?= $barang->stok ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>