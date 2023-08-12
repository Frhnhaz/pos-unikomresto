<?php
include 'proses/connect.php';
date_default_timezone_set('Asia/Jakarta');

$query = mysqli_query($conn, "SELECT *, SUM(harga * jumlah ) AS harga_total FROM tb_order
        LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
        LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
        LEFT JOIN tb_menu ON tb_menu.id = tb_list_order.menu
        JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
        GROUP BY id_order ORDER BY waktu_order DESC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

?>

<!-- content -->
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header text-center">
            <h3>Laporan Pesanan</h3> 
        </div>
        <div class="card-body">

            <?php
            if (empty($result)) {
                echo "Data pesanan tidak ada";
            } else {
                foreach ($result as $row) {
            ?>
         
                <?php } ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Waktu Order</th>
                                <th scope="col">Waktu Bayar</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Meja</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Pelayan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr class="text-nowrap">
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $row['id_order'] ?></td>
                                    <td><?php echo $row['waktu_order'] ?></td>
                                    <td><?php echo $row['waktu_bayar'] ?></td>
                                    <td><?php echo $row['pelanggan'] ?></td>
                                    <td><?php echo $row['meja'] ?></td>
                                    <td><?php echo number_format($row['harga_total'], 0, ".", ",")  ?></td>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-sm btn-info me-1" href="./?x=viewitem&order=<?php echo $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan'] ?>"><i class="fa-regular fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                        </tbody>
                    <?php } ?>
                    </table>
                </div>
            <?php } ?>

        </div>
    </div>
</div>
<!-- End Content -->