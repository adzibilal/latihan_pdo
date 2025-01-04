<?php
class Barang {
    private $conn;
    private $table_name = "barang";

    public $id;
    public $nama;
    public $harga;
    public $stok;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nama, harga, stok) VALUES (:nama, :harga, :stok)";
        $stmt = $this->conn->prepare($query);

        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->harga = htmlspecialchars(strip_tags($this->harga));
        $this->stok = htmlspecialchars(strip_tags($this->stok));

        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":stok", $this->stok);

        return $stmt->execute();
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nama = $row['nama'];
        $this->harga = $row['harga'];
        $this->stok = $row['stok'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                SET nama = :nama, harga = :harga, stok = :stok 
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->harga = htmlspecialchars(strip_tags($this->harga));
        $this->stok = htmlspecialchars(strip_tags($this->stok));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":stok", $this->stok);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}
?>