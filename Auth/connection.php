<?php
$server = '127.0.0.1';
$username = 'u426563386_5HD6M';
$password = 'p28mipJ47h';
$database = 'u426563386_NHGI4';

if (isset($_POST))

    $conn = new mysqli($server, $username, $password, $database);
if ($conn) {
    // echo 'Server Connected Success';
} else {
    die(mysqli_error($conn));
}
