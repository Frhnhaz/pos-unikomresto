<?php
session_start();
include 'connect.php';

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['siapsaji_validate'])){
        $query = mysqli_query($conn, "UPDATE tb_list_order SET  status=2 WHERE id_list_order='$id' ");
        if(!$query){
            $message = '<script>alert("Pesanan gagal disajikan")
            window.location="../dapur"
            </script>;'; 
        }else{
            $message = '<script>alert("Pesanan telah disajikan")
            window.location="../dapur"
            </script>;';       
        }
    
}echo $message;
