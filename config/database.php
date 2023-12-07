<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'laundry';

$conn = mysqli_connect($hostname, $username, $password, $db_name);

if (!$conn)
    die('Koneksi Gagal! ' . mysqli_connect_error());
