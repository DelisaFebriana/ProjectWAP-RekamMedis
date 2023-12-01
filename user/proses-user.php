<?php 

require "../config.php";

if(isset($_POST['simpan'])) {
    $username  = trim(htmlspecialchars($_POST['username']));
    $nama      = trim(htmlspecialchars($_POST['fullname']));
    $jabatan   = $_POST['jabatan'];
    $alamat    = trim(htmlspecialchars($_POST['alamat']));
    $gambar    = htmlspecialchars($_FILES['gambar']['name']);
    $password  = trim(htmlspecialchars($_POST['password']));
    $password2 = trim(htmlspecialchars($_POST['password2']));

    $cekUsername = mysqli_query($koneksi, "SELECT * FROM 
    tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername)) {
        echo "<script>
                alert('username sudah terpakai, user baru gagal di registrasi !');
                window.location = 'tambah-user.php';
        </script>";
        return;
    }

    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai, user baru gagal di registrasi !');
                window.location = 'tambah-user.php';
        </script>";
        return; 
    }

    $pass = password_hash($password, PASSWORD_DEFAULT);

    if($gambar != null) {
        $url = 'tambah-user.php';
        $gambar = uploadGbr($url);
    } else {
        $gambar = 'use r.png';
    }

    mysqli_query($koneksi, "INSERT INTO tbl_user VALUES (null, '$username', '$nama', '$pass', '$jabatan', '$alamat', '$gambar')");

    echo "<script>
                alert('User baru berhasil di registrasi !');
                window.location = 'tambah-user.php';
        </script>";
    return;
}

if (@$_GET['aksi'] == 'hapus-user') {
    $id = $_GET['id'];
    $gbr = $_GET['gambar'];

    mysqli_query($koneksi, "DELETE FROM tbl_user WHERE userid = $id");
    if ($gbr != 'user.png') {
        unlink('../asset/gambar/' . $gbr);
    }

    echo "<script>
                alert('User berhasil dihapus !');
                window.location = 'index.php';
        </script>";
    return;
}

if(isset($_POST['update'])) {
    $id        = $_POST['id'];
    $userLama  = trim(htmlspecialchars($_POST['usernameLama']));
    $nama      = trim(htmlspecialchars($_POST['fullname']));
    $jabatan   = $_POST['jabatan'];
    $alamat    = trim(htmlspecialchars($_POST['alamat']));
    $gambar    = htmlspecialchars($_FILES['gambar']['name']);
    $gbrLama   = htmlspecialchars($_POST['gbrLama']);

    $cekUsername = mysqli_query($koneksi, "SELECT * FROM 
    tbl_user WHERE username = '$username'");

    if ($username !== $userLama) {
        if (mysqli_num_rows($cekUsername)) {
             echo "<script>
                alert('username sudah terpakai, data user gagal di perbarui !');
                window.location = 'index.php';
        </script>";
        return;
         }
    } 

    if($gambar != null) {
        $url = 'index.php';
        $gbrUser = uploadGbr($url);
        if ($gbrLama !== 'user.png') {
            @unlink('../asset/gambar/' . $gbrLama);
        }
    } else {
        $gbrUser = $gbrLama;
    }

    mysqli_query($koneksi, "UPDATE tbl_user SET
                            username    = '$username',
                            fullname    = '$nama',
                            jabatan     = '$jabatan',
                            alamat      = '$alamat',
                            gambar      = '$gbrUser'
                            WHERE userid = $id
                            ");

    echo "<script>
                alert('Data User berhasil di rperbarui !');
                window.location = 'index.php';
        </script>";
    return;
}

?>