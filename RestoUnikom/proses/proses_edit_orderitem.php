<?php
session_start();
include 'connect.php';

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah = (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";



if (!empty($_POST['edit_orderitem_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_list_order WHERE menu = '$menu' && kode_order = $kode_order AND id_list_order!='$id'");
    if (mysqli_num_rows($select) > 0) {
        $query = mysqli_query($conn, "UPDATE tb_list_order SET menu='$menu', jumlah='$jumlah', catatan='$catatan' WHERE id_list_order='$id' ");
        if (!$query) {
            $message = '<script>alert("Item gagal ditambahkan")
            window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"
            </script>;';
        } else {
            $message = '<script>alert("Item berhasil ditambahkan")
                        window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"
                        </script>;';
        }
    }
}
echo $message;
