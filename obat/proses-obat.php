<?php 

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

require "../config.php";



// tambah obat baru
if (isset($_POST['simpan'])) {
    $nama     = trim(htmlspecialchars($_POST['nama']));
    $kegunaan = trim(htmlspecialchars($_POST['kegunaan']));
    

    mysqli_query($koneksi, "INSERT INTO tbl_obat VALUES (null, '$nama', '$kegunaan')");

   header('location: tambah-obat.php?msg=added');
    return;


}


?>