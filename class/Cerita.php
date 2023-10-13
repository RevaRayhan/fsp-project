<?php
    require_once("Koneksi.php");

class Cerita extends Koneksi {
    public int $idcerita;
    public string $judul;
    public string $iduser;

    public function __construct() {
        Koneksi::__construct();
    }

    public function getCerita($search="%") {
        $stmt = $this -> con -> prepare("SELECT * FROM cerita WHERE judul LIKE ?");
        $stmt -> bind_param("s", $search);
        $stmt -> execute();
        $result = $stmt -> get_result();
        return $result;
    }

    public function getCeritaLimit($search="%", $start=0, $perpage=3) {
        $stmt = $this -> con -> prepare("SELECT * FROM cerita WHERE judul LIKE ? LIMIT ?,?");
        $stmt -> bind_param("sii", $search, $start, $perpage);
        $stmt -> execute();
        $result = $stmt -> get_result();
        return $result;
    }
}