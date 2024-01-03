<?php 

session_start();

if (!isset($_SESSION['ssLoginRM'])) {
  header("location: ../otentikasi/index.php");
  exit();
}

require "../config.php";

$title = "Tambah Data - Rekam Medis";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Data Perekaman</h1>
        <a href="<?= $main_url ?>rekamedis" class="text-decoration-none"><i class="bi bi-arrow-left align-top"></i> Kembali</a>
      </div>

      <form action="proses-data.php" method="post">
        <div class="row">
            <div class="col-lg-6 pe-4">
                <div class="form-group mb-3">
                    <label for="no" class="form-label">No Rekam Medis</label>
                    <input type="text" name="no_rm" class="form-control" id="nama" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="tgl" class="form-label">tgl Perekaman</label>
                    <input type="date" name="tgl" class="form-control" id="tgl" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="pasien" class="form-label">Pasien</label>
                    <div class="ibput-group mb-3">
                      <input type="text" class="form-control" id="pasien_id" name="id" placeholder="ID Pasien" readonly>
                      <button class="btn btn-outline-secondary" type="button" id="cari" data-bs-toggle="modal" data-bs-target="#modalPasien"><i class="bi bi-search align-top"></i></button>
                    </div>
                </div>
                <input type="text" class="form-control border-0 border-bottom mb-3" placeholder="nama pasien" readonly>
                <textarea name="" id="" class="form- control border-0 border-bottom" placeholder="alamat pasien" rows="1" readonly></textarea>
                <button type="reset" class="btn btn-outline-danger btn-sm"><i 
                class="bi bi-x-lg align-top"></i> Reset</button>
                <button type="submit" name="simpan" class="btn btn-outline-primary btn-sm"><i 
                class="bi bi-save align-top"></i></button>
            </div>
        </div>
      </form>


      <!-- Modal -->
<div class="modal fade" id="modalPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
            <h3>Cari Pasien</h3>
            <table class="table table-responsive table-hover" id="myTable" ></table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pasien</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $queryPasien = mysqli_query($koneksi, "SELECT * FROM tbl_pasien");
                    while ($pasien = mysqli_fetch_assoc($queryPasien)) { ?>
                        <tr>
                            <td><?= $no++ ?><td>
                            <td><?= $pasien['id'] ?><td>
                            <td><?= $pasien['nama'] ?><td>
                            <td><?= $pasien['alamat'] ?><td>
                            <td>
                                <button type="button" title="pilih pasien" id="cekPasien" data-id="<?= $pasien['id'] ?>" data-namapasien="<?= $pasien['nama'] ?>" data-address="<?= $pasien['alamat'] ?>" class="btn btn-sm btn-outline-primary cekPasien"><i class="bi bi-check-lg align-top"></i></button>
                            </td>
                        </tr>  
                    <?php } ?>
                </tbody>
            </table>
      </div>    
    </div>
  </div>
</div>
</main>

<script>
  $(document).ready(function (){
    $(document).on('click','cekPasien', function () {
      let pasienID = $(this).data('id');
      let pasienName = $(this).data('namapasien');
      let pasienaddress = $(this).data('address');
      $('#pasien_id').val(pasienID);
    })
  })
</script>
    

<?php 

require "../template/footer.php";

?>