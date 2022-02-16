<?php
session_start();
require '../config/database.php';

$id = $_GET['id'];

$del = mysqli_query($conn, "DELETE FROM tb_user WHERE id = $id");

if ($del) {
    $_SESSION['deleted'] = true;
    header('Location: pengguna.php');
} else {
    $_SESSION['notDeleted'] = true;
    header('Location: pengguna.php');
}
