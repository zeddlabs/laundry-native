<?php
require_once 'database.php';

function query($query)
{
    global $conn;

    $rows = [];
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// CRUD Pelanggan
function insertDataPelanggan($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $jenisKelamin = htmlspecialchars($data['jenisKelamin']);
    $telepon = htmlspecialchars($data['telepon']);

    mysqli_query($conn, "INSERT INTO tb_member VALUES (NULL, '$nama', '$alamat', '$jenisKelamin', '$telepon')");

    return mysqli_affected_rows($conn);
}

function updateDataPelanggan($data)
{
    global $conn;

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $jenisKelamin = htmlspecialchars($data['jenisKelamin']);
    $telepon = htmlspecialchars($data['telepon']);

    mysqli_query($conn, "UPDATE tb_member SET nama = '$nama', alamat = '$alamat', jenis_kelamin = '$jenisKelamin', tlp = '$telepon' WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// CRUD Outlet
function insertDataOutlet($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $telepon = htmlspecialchars($data['telepon']);

    mysqli_query($conn, "INSERT INTO tb_outlet VALUES (NULL, '$nama', '$alamat', '$telepon')");

    return mysqli_affected_rows($conn);
}

function updateDataOutlet($data)
{
    global $conn;

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $telepon = htmlspecialchars($data['telepon']);

    mysqli_query($conn, "UPDATE tb_outlet SET nama = '$nama', alamat = '$alamat', tlp = '$telepon' WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// CRUD Paket
function insertDataPaket($data)
{
    global $conn;

    $outlet = $data['outlet'];
    $jenis = $data['jenis'];
    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['harga']);

    mysqli_query($conn, "INSERT INTO tb_paket VALUES (NULL, $outlet, '$jenis', '$nama', $harga)");

    return mysqli_affected_rows($conn);
}

function updateDataPaket($data)
{
    global $conn;

    $id = $data['id'];
    $outlet = $data['outlet'];
    $jenis = $data['jenis'];
    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['harga']);

    mysqli_query($conn, "UPDATE tb_paket SET id_outlet = $outlet, jenis = '$jenis', nama_paket = '$nama', harga = $harga WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// CRUD Pengguna
function insertDataPengguna($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $outlet = htmlspecialchars($data['outlet']);
    $role = htmlspecialchars($data['role']);

    mysqli_query($conn, "INSERT INTO tb_user VALUES (NULL, '$nama', '$username', '$password', $outlet, '$role')");

    return mysqli_affected_rows($conn);
}

function updateDataPengguna($data)
{
    global $conn;

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $outlet = htmlspecialchars($data['outlet']);
    $role = htmlspecialchars($data['role']);

    mysqli_query($conn, "UPDATE tb_user SET nama = '$nama', username = '$username', id_outlet = $outlet, role = '$role' WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// CRUD Transaksi
function insertDataTransaksi($data)
{
    global $conn;

    $idTransaksi = htmlspecialchars($data['idTransaksi']);
    $outlet = htmlspecialchars($data['outlet']);
    $invoice = htmlspecialchars($data['invoice']);
    $member = htmlspecialchars($data['member']);
    $tgl = htmlspecialchars($data['tgl']);
    $batas = htmlspecialchars($data['batas']);
    $tglBayar = ($data['tglBayar'] == "") ? NULL : $data['tglBayar'];
    $tambahan = htmlspecialchars($data['tambahan']);
    $dibayar = htmlspecialchars($data['dibayar']);
    $user = htmlspecialchars($data['user']);
    $paket = htmlspecialchars($data['paket']);
    $qty = htmlspecialchars($data['qty']);
    $keterangan = htmlspecialchars($data['keterangan']);
    $harga = htmlspecialchars($data['harga']);
    $total = $harga * $qty;
    $diskon = ($total >= 100000) ? 10000 : 0;
    $pajak = ($total >= 50000) ? 5000 : 0;

    // var_dump($tglBayar);
    mysqli_query($conn, "INSERT INTO tb_transaksi VALUES ($idTransaksi, $outlet, '$invoice', $member, '$tgl', '$batas', " . ($tglBayar == NULL ? "NULL" : "'$tglBayar'") . ", $tambahan, $diskon, $pajak, 'baru', '$dibayar', $user)");
    mysqli_query($conn, "INSERT INTO tb_detail_transaksi VALUES (NULL, $idTransaksi, $paket, $qty, '$keterangan')");

    return mysqli_affected_rows($conn);
}

function updateDataTransaksi($data)
{
    global $conn;

    $id = $data['id'];
    $status = htmlspecialchars($data['status']);
    $dibayar = htmlspecialchars($data['dibayar']);
    $tglBayar = ($dibayar == 'dibayar') ? date('Y-m-d') : NULL;

    mysqli_query($conn, "UPDATE tb_transaksi SET status = '$status', dibayar = '$dibayar', tgl_bayar = " . ($tglBayar == NULL ? "NULL" : "'$tglBayar'") . " WHERE id = $id");

    return mysqli_affected_rows($conn);
}
