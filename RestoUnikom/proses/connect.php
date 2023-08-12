<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_resto';

$conn = mysqli_connect($host,$user,$pass,$db);
if(!$conn){
    die("Error: Tidak dapat tersambung.".mysqli_connect_error());
}

?>