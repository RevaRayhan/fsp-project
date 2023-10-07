<?php

class Koneksi {
    protected $con;

    public function construct() {
        $this -> con = new mysqli("localhost", "root", "", "movie_fsp");
    }

    public function destruct() {
        $this -> con -> close();
    }
}