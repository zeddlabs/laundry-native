<?php
$title = 'Pelanggan';
include '../templates/header.php';

if (isset($_POST['simpan'])) {
    if (insertDataPelanggan($_POST) > 0) {
        $_SESSION['inserted'] = true;
        header('Location: pelanggan.php');
    } else {
        $_SESSION['notInserted'] = true;
    }
}
?>
<?php include '../templates/kasir/navbar.php'; ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php
    if (isset($_SESSION['notInserted'])) {
        echo '<div class="alert alert-danger">Data gagal ditambahkan!</div>';
        unset($_SESSION['notInserted']);
    }
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pelanggan</h1>
        <a class="btn btn-secondary" href="pelanggan.php"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Pelanggan</h6>
        </div>
        <div class="row card-body align-items-center">
            <div class="col-md text-center">
                <img src="../assets/img/undraw_add_user_re_5oib.svg" alt="" style="width: 350px;">
            </div>
            <div class="col-md">
                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama" placeholder="" name="nama">
                        <label for="nama">Nama Pelanggan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="" id="alamat" name="alamat"></textarea>
                        <label for="alamat">Alamat</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="jenisKelamin" aria-label="Floating label select example" name="jenisKelamin">
                            <option selected>Pilih jenis kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <label for="jenisKelamin">Jenis Kelamin</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telepon" placeholder="" name="telepon">
                        <label for="telepon">No. Telepon</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include '../templates/footer.php'; ?>