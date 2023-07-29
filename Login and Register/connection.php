<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'login_register_db';

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Add columns if they do not exist in the table
$sql = "SHOW COLUMNS FROM `tbl_user` LIKE 'is_verified'";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    $alterQuery = "ALTER TABLE `tbl_user`
    ADD COLUMN `is_verified` TINYINT(1) NOT NULL DEFAULT '0',
    ADD COLUMN `verification_code` VARCHAR(32) NOT NULL DEFAULT ''";

    if ($conn->query($alterQuery) === TRUE) {
        echo "Columns 'is_verified' and 'verification_code' added successfully to table 'tbl_user'.";
    } else {
        echo "Error adding columns: " . $conn->error;
    }
}
