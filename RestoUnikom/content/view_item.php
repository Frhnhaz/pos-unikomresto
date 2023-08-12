<?php
include 'proses/connect.php';
$query = mysqli_query($conn, "SELECT *, SUM(harga * jumlah ) AS harga_total FROM tb_list_order
        LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
        LEFT JOIN tb_menu ON tb_menu.id = tb_list_order.menu
        LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
        GROUP BY id_list_order
        HAVING tb_list_order.kode_order = $_GET[order] ");

$kode = $_GET['order'];
$meja = $_GET['meja'];
$pelanggan = $_GET['pelanggan'];

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_menu = mysqli_query($conn, "SELECT id, nama_menu FROM tb_menu");

?>

<!-- content -->
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header text-center">
            <h3>Detail Pesanan</h3>
        </div>
        <div class="card-body">
            <a href="report" class="btn btn-info mb-3"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="kodeorder" value="<?php echo $kode ?>">
                        <label for="kodeorder">Kode Order</label>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="meja" value="<?php echo $meja ?>">
                        <label for="meja">Meja</label>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="pelanggan" value="<?php echo $pelanggan ?>">
                        <label for="pelanggan">Pelanggan</label>
                    </div>
                </div>
            </div>

            <!-- Modal tambah item -->

            <?php
            if (empty($result)) {
                echo "Belum ada pesanan";
            } else {
                foreach ($result as $row) {
            ?>

                <?php } ?>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Status</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($result as $row) {
                            ?>
                                <tr class="text-nowrap">
                                    <td><?php echo $row['nama_menu'] ?></td>
                                    <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td><?php echo $row['jumlah'] ?></td>
                                    <td><?php 
                                    if ($row['status'] == 1){
                                        echo "<span class='badge text-bg-primary'>Masuk ke dapur</span>
                                        ";
                                    }elseif ($row['status']==2){
                                        echo "<span class='badge text-bg-warning'>Siap Saji</span>
                                        ";
                                    }
                                 ?></td>
                                    <td><?php echo $row['catatan'] ?></td>
                                    <td><?php echo number_format($row['harga_total'], 0, ',', '.') ?></td>
                                </tr>
                        </tbody>
                    <?php
                                $total += $row['harga_total'];
                            }
                    ?>
                    <tr>
                        <td class="fw-bold" colspan="5">
                            Total Harga
                        </td>
                        <td class="fw-bold">
                            <?php echo number_format($total, 0, ',', '.') ?>
                        </td>
                    </tr>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- End Content -->