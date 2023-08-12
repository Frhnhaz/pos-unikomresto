<?php
include "connect.php";

$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan = (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
$kat_menu = (isset($_POST['kat_menu'])) ? htmlentities($_POST['kat_menu']) : "";
$harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";



// Target direktori penyimpanan gambar
$kode_rand = rand(10000, 99999)."-";
$target_dir = "../assets/img/".$kode_rand;
$target_file = $target_dir.basename($_FILES['foto']['name']);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if(!empty($_POST['input_menu_validate'])){
    // Cek gambar atau bukan
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if($cek === false){
        $message = "Ini bukan file gambar";
        $statusUpload = 0;
    }else{
        // Cek file sudah ada atau belum
        $statusUpload = 1;
        if(file_exists($target_file)){
            $message = "Maaf, file sudah ada";
            $statusUpload = 0;
        }else{
            // Pembatasan ukuran
            if($_FILES['foto']['size'] > 500000){   //500Kb
                $message = "File terlalu besar";
                $statusUpload = 0;
            }else{
                // Cek ekstensi
                if($imageType != 'jpg' && $imageType != 'png' && $imageType != 'jpeg' && $imageType != 'gif'){
                    $message = "Format harus jpg, jpeg, png, atau gif";
                    $statusUpload = 0;
                }
            }
        }
    }
}

// Pesan error
if($statusUpload == 0){
    $message = '<script>alert("'.$message.', gambar tidak dapat diupload")
    window.location="../menu"</script>';
}else{
    $select = mysqli_query($conn, "SELECT * FROM tb_menu WHERE nama_menu = '$nama_menu'");
    if (mysqli_num_rows($select) > 0){
        $message = '<script>alert("Menu sudah ada")
    window.location="../menu"</script>';
    }else{
        if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)){
            $query = mysqli_query($conn, "INSERT INTO tb_menu (foto, nama_menu, keterangan, kategori, harga) values ('".$kode_rand.$_FILES['foto']['name']."', '$nama_menu', '$keterangan', '$kat_menu', '$harga')");
            if ($query){
                $message = '<script>alert("Menu berhasil ditambahkan")
                window.location="../menu"</script>';
            }else{
                $message = '<script>alert("Menu gagal ditambahkan")
                window.location="../menu"</script>';
            }
        }else{
            $message = '<script>alert("Terjadi kesalahan file tak dapat diupload")
            window.location="../menu"</script>';
        }
    }
}
echo $message;