<?php
session_start();
require '../config/database.php';

$id = $_GET['id'];

$del = mysqli_query($conn, "DELETE tb_transaksi, tb_detail_transaksi FROM tb_transaksi, tb_detail_transaksi WHERE tb_transaksi.id = $id AND tb_detail_transaksi.id_transaksi = $id");

if ($del) {
    $_SESSION['deleted'] = true;
    header('Location: transaksi.php');
} else {
    $_SESSION['notDeleted'] = true;
    header('Location: transaksi.php');
}
