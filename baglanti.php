<?php
$host = 'localhost:3307';
$user = 'root';
$pass = 'Asli1205?'; 
$dbname = 'dis_asistani';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
