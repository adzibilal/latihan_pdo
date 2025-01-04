<?php
require_once "config/database.php";
require_once "models/Barang.php";

$database = new Database();
$db = $database->getConnection();
$barang = new Barang($db);

if (isset($_GET['id'])) {
    $barang->id = $_GET['id'];
    
    if ($barang->delete()) {
        header("Location: index.php");
    }
}
?>