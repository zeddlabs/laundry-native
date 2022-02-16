<?php
$conn = mysqli_connect('localhost', 'root', '', 'laundry');

if (!$conn)
    die('Koneksi Gagal! ' . mysqli_connect_error());
