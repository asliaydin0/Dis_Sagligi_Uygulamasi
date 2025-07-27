<?php
$host = 'localhost';
$user = 'root';
$pass = ''; 
$dbname = 'dis_asistani';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
