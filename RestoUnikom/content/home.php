<?php
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$_SESSION[username_resto]' ");
$records = mysqli_fetch_array($query);
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header text-center">
            <h1 class="card-title mb-5">Resto Unikom</h1>
            Selamat datang, Tuan/Nyonya <b><?php echo $records['nama'] ?></b>. <br>
            <?php
                if ($records['level'] == 1){
                    echo "Apa yang ingin Anda lakukan hari ini? Silahkan menuju menu sidebar untuk memulai pekerjaan";
                }elseif($records['level'] == 2){
                    echo "Selamat mengerjakan pekerjaan Anda";
                }elseif($records['level'] == 3){
                    echo "jangan lupa untuk selalu tersenyum kepada pelanggan :) ";
                }else{
                    echo "Silahkan menuju halaman dapur untuk memulai mengkonfirmasi status menu.";
                }
            ?>
        </div>
    </div>
</div>