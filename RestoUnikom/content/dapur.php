<?php
include 'proses/connect.php';
$query = mysqli_query($conn, "SELECT * FROM tb_list_order
        LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
        LEFT JOIN tb_menu ON tb_menu.id = tb_list_order.menu
        LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order ORDER BY waktu_order DESC");

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_menu = mysqli_query($conn, "SELECT id, nama_menu FROM tb_menu");

?>

<!-- content -->
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header text-center">
            <h3>Pesanan yang Diproses</h3>
        </div>
        <div class="card-body">
        </div>

        <?php
        if (empty($result)) {
            echo "Belum ada pesanan";
        } else {
            foreach ($result as $row) {
        ?>
                <!-- Modal terima dapur -->
                <div class="modal fade" id="terima<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Terima Pesanan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_terima_orderitem.php" method="post" novalidate>
                                    <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                    <input type="hidden" name="kode_order" value="<?php echo $kode ?>">

                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="form-floating mb-3">
                                                <select disabled class="form-select" name="menu" id="menu">
                                                    <option selected hidden value="">Pilih Menu</option>
                                                    <?php
                                                    foreach ($select_menu as $value) {
                                                        if ($row['menu'] == $value['id']) {
                                                            echo "<option selected value=$value[id]>$value[nama_menu]</option>";
                                                        } else {
                                                            echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="menu">Menu Makanan/ Minuman</label>
                                                <div class="invalid-feedback">
                                                    Pilih Menu.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-floating mb-3">
                                                <input disabled name="jumlah" type="number" min="0" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" value="<?php echo $row['jumlah'] ?>" required>
                                                <label for="floatingInput">Jumlah</label>
                                                <div class="invalid-feedback">
                                                    Masukkan jumlah
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input name="catatan" type="text" class="form-control" id="catatan" value="<?php echo $row['catatan'] ?>" placeholder="Catatan">
                                                <label for="catatan">Catatan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button name="terima_orderitem_validate" type="submit" class="btn btn-primary" value="12345">Terima</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Siap saji -->
                <div class="modal fade" id="siapSaji<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pesanan sudah siap?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_siapsaji_orderitem.php" method="post" novalidate>
                                    <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Belum</button>
                                        <button name="siapsaji_validate" type="submit" class="btn btn-primary" value="12345">Pesanan Siap</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            <?php } ?>

            </script>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Kode Order</th>
                            <th scope="col">Waktu Order</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($result as $row) {
                            if ($row['status'] != 2) {


                        ?>
                                <tr class="text-nowrap">
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['kode_order'] ?></td>
                                    <td><?php echo $row['waktu_order'] ?></td>
                                    <td><?php echo $row['nama_menu'] ?></td>
                                    <td><?php echo $row['jumlah'] ?></td>
                                    <td><?php echo $row['catatan'] ?></td>
                                    <td><?php
                                        if ($row['status'] == 1) {
                                            echo "<span class='badge text-bg-primary'>Masuk ke dapur</span>
                                        ";
                                        } elseif ($row['status'] == 2) {
                                            echo "<span class='badge text-bg-warning'>Siap Saji</span>
                                        ";
                                        }
                                        ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn-sm me-1 <?php echo (!empty($row['status'])) ? "btn btn-secondary disabled" : 'btn btn-primary' ?> " data-bs-toggle="modal" data-bs-target="#terima<?php echo $row['id_list_order'] ?>">Terima</button>

                                            <button type="button" class="btn-sm me-1 <?php echo (empty($row['status']) || $row['status'] != 1) ? "btn btn-secondary disabled" : 'btn btn-success' ?>" data-bs-toggle="modal" data-bs-target="#siapSaji<?php echo $row['id_list_order'] ?>">Siap Saji</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                    </tbody>
                <?php
                        }
                ?>
                </table>
            </div>
        <?php } ?>
    </div>
</div>
</div>
<!-- End Content -->