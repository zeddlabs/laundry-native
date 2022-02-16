<?php
$title = 'Transaksi';
include '../templates/header.php';

$idTerbesar = query("SELECT MAX(id) AS idTerbesar FROM tb_transaksi")[0];
$idTransaksi = $idTerbesar['idTerbesar'] + 1;

$outlet = query("SELECT id, nama FROM tb_outlet");
$member = query("SELECT id, nama FROM tb_member");
$user = query("SELECT id, nama FROM tb_user");
$paket = query("SELECT id, nama_paket, harga FROM tb_paket");

if (isset($_POST['simpan'])) {
    // var_dump($_POST);
    if (insertDataTransaksi($_POST) > 0) {
        $_SESSION['inserted'] = true;
        header('Location: transaksi.php');
    } else {
        $_SESSION['notInserted'] = true;
    }
}
?>
<?php include '../templates/admin/navbar.php'; ?>
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
        <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
        <a class="btn btn-secondary" href="transaksi.php"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Transaksi</h6>
        </div>
        <form action="" method="post">
            <input type="hidden" name="idTransaksi" value="<?= $idTransaksi; ?>">
            <div class="row card-body">
                <div class="col-md">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="outlet" aria-label="Floating label select example" name="outlet" required>
                            <option selected disabled>Pilih outlet</option>
                            <?php foreach ($outlet as $o) : ?>
                                <option value="<?= $o['id']; ?>"><?= $o['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="outlet">Outlet</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="invoice" placeholder="" name="invoice" readonly value="<?= date('YmdHis'); ?>">
                        <label for="invoice">Kode Invoice</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="member" aria-label="Floating label select example" name="member" required>
                            <option selected disabled>Pilih member</option>
                            <?php foreach ($member as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="member">Member</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="tgl" placeholder="" name="tgl" readonly value="<?= date('Y-m-d'); ?>" required>
                        <label for="tgl">Tanggal Transaksi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="batas" placeholder="" name="batas" required>
                        <label for="batas">Batas Waktu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="tglBayar" placeholder="" name="tglBayar">
                        <label for="tglBayar">Tanggal Bayar</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="tambahan" placeholder="" name="tambahan" required>
                        <label for="tambahan">Biaya Tambahan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="dibayar" aria-label="Floating label select example" name="dibayar" required>
                            <option value="belum dibayar" selected>Belum Dibayar</option>
                            <option value="dibayar">Dibayar</option>
                        </select>
                        <label for="dibayar">Status Pembayaran</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="user" aria-label="Floating label select example" name="user" required>
                            <option selected disabled>Pilih user</option>
                            <?php foreach ($user as $u) : ?>
                                <option value="<?= $u['id']; ?>"><?= $u['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="user">Petugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="paket" aria-label="Floating label select example" name="paket" required>
                            <option selected disabled>Pilih paket</option>
                            <?php foreach ($paket as $p) : ?>
                                <option value="<?= $p['id']; ?>"><?= $p['nama_paket']; ?></option>
                                <input type="hidden" name="harga" value="<?= $p['harga']; ?>">
                            <?php endforeach; ?>
                        </select>
                        <label for="paket">Petugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="qty" placeholder="" name="qty" required>
                        <label for="qty">Qty</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="keterangan" id="keterangan" class="form-control" placeholder="" required></textarea>
                        <label for="keterangan">Keterangan</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="simpan">Simpan</button>
                </div>
            </div>
        </form>
    </div>


</div>
<!-- /.container-fluid -->
<?php include '../templates/footer.php'; ?>