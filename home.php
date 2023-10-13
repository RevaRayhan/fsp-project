<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        li {
            display: inline-block;
            width: 50px;
        }
        th {
            background-color: #e4e4e4;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <form method="GET" action="">
        Cari Judul <input type="text" name="keyword" id="input-keyword">
        <input type="submit" name="cari" id="btn-cari" value="judul">
    </form>
    <a href="tambah-cerita.php">
        <button>Buat Cerita Baru</button>
    </a>
    <br><br>
    <div class="container">
        <?php 
            require_once("class/Cerita.php");

            if (isset($_GET['keyword'])) {
                $key = $_GET['keyword'];
                $search = "%". $key. "%";
            }
            else {
                $search = "%";
                $key = "";
            }

            $cerita = new Cerita();
            $result = $cerita -> getCerita($search);

            $perpage = 3;
            $totalData = $result -> num_rows;
            $jumlahpage = ceil($totalData / $perpage);

            if (isset($_GET['page'])) $page = $_GET['page'];
            else $page = 1;
            if (!is_numeric($page)) $page = 1;

            $start = ($page - 1) * $perpage;
            $result = $cerita -> getCeritaLimit($search, $start, $perpage);

            echo "<table border=1>";
            echo "<tr><th>Judul</th><th>Pembuat Awal</th><th>Aksi</th>";
            while($row = $result -> fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row['judul']. "</td>";
                echo "<td>". $row['users_pembuat_awal'];
                echo "<td><a href='detail-cerita.php?id=". $row['idcerita']. "'>Lihat Cerita</a></td>";
                echo "</tr>";
            }
            echo "</table>";

            echo "<ul>";
            for ($i = 1; $i <= $jumlahpage; $i++) {
                echo "<li><a href='home.php?page=$i&key=$key'>$i</a></li>";
            }
            echo "</ul>";
        ?>
    </div>
</body>
</html>