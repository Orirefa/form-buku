<?php
include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Daftar Buku</title>
  <style type="text/css">
  * {
    font-family: sans-serif;
  }

  .tambah {
    position: relative;
    right: 500px;

  }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h1 class="text-center">Daftar Buku</h1>
    <form class="d-flex" action="index.php" method="get">
        <input name="cari" class="form-control me-2" type="text" placeholder="Cari">
        <button class="btn btn-outline-success" type="submit" value="cari">Search</button>
      </form><br><br>
      
        <form action="" method="POST">
            <?php echo "<h1>Selamat Datang, " . $_SESSION['username'] ."!". "</h1>"; ?>
            <a href="logout.php" class="btn btn-danger my-3">Logout</a>
        </form>
   
      <a href="tambah_produk.php" class="text-center btn btn-danger"> Tambah </a>
    <br />
    <div class ="container my-3 mx-auto">
      <div class="row">
        <?php
            $query = "SELECT * FROM buku ORDER BY id_buku ASC";
            $result = mysqli_query($koneksi, $query);
            if (!$result) {
              die("Query Error: " . mysqli_errno($koneksi) .
                " - " . mysqli_error($koneksi));
            }
            ?>
        <?php
            if (isset($_GET['cari'])) {
              $cari = $_GET['cari'];
              $result = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul LIKE '%" . $cari . "%'");
            } else {
              $result = mysqli_query($koneksi, $query);
            }
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>

          <div class="col-sm-3 p-2 m-3 bg-primary align-self-center rounded text-center">
            <img src="../gambar<?php echo $row['gambar']; ?>" style="width: 120px;height: 200px;" class="rounded mx-auto d-block">
            <p class="h3 text-white fw-bold"><?php echo $row['judul']; ?></p>
            <p class="h4 text-white fw-600"><?php echo substr($row['pengarang'], 0, 20); ?></p>
            <p class="h4 text-white fw-600"><?php echo substr($row['penerbit'], 0, 20); ?></p>
            <p class="h4 text-white fw-600"><?php echo $row['tahun']; ?></p>
            <a href="edit_produk.php?id_buku=<?php echo $row['id_buku']; ?>" class="btn btn-warning rounded">Edit</a>
            <a href="proses_hapus.php?id_buku=<?php echo $row['id_buku']; ?>" class="btn btn-danger rounded" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
          </div>
        <?php } ?>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>