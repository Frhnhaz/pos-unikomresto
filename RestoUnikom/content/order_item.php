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
           <h3>Halaman Barang Pesanan</h3> 
        </div>
        <div class="card-body">
            <a href="order" class="btn btn-info mb-3"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
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
            <div class="modal fade" id="tambahItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pesanan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="proses/proses_input_orderitem.php" method="post" novalidate>
                                <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">

                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="menu" id="menu">
                                                <option selected hidden value="">Pilih Menu</option>
                                                <?php
                                                foreach ($select_menu as $value) {
                                                    echo "<option value=$value[id]>$value[nama_menu]</option>";
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
                                            <input name="jumlah" type="number" min="0" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" required>
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
                                            <input name="catatan" type="text" class="form-control" id="catatan" placeholder="Catatan">
                                            <label for="catatan">Catatan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button name="input_orderitem_validate" type="submit" class="btn btn-primary" value="12345">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (empty($result)) {
                echo "Belum ada pesanan";
            } else {
                foreach ($result as $row) {
            ?>

                    <!-- Modal edit menu -->
                    <div class="modal fade" id="modalEdit<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pesanan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_edit_orderitem.php" method="post" novalidate>
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">

                                        <div class="row">
                                            <div class="col-lg-9">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="menu" id="menu">
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
                                                    <input name="jumlah" type="number" min="0" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" value="<?php echo $row['jumlah'] ?>" required>
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
                                            <button name="edit_orderitem_validate" type="submit" class="btn btn-primary" value="12345">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal delete user -->
                    <div class="modal fade" id="modalDelete<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_delete_orderitem.php" method="post" novalidate>
                                        <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <div class="col-lg-12">
                                            Apakah Anda ingin menghapus pesanan <b><?php echo $row['nama_menu'] ?></b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button name="delete_orderitem_validate" type="submit" class="btn btn-danger" value="12345">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

                <!-- Modal Bayar -->
                <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Bayar Pesanan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
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
                                                            <td><?php echo $row['status'] ?></td>
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
                                    </div>
                                    <span class="text-danger fs-5 fw-semibold">Apakah Anda yakin ingin melakukan pembayaran</span>
                                    <form class="needs-validation" action="proses/proses_bayar.php" method="post" novalidate>

                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <input type="hidden" name="total" value="<?php echo $total ?>">

                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input name="uang" type="number" min="0" class="form-control" id="floatingInput" placeholder="Nominal Uang" min="0" required>
                                                <label for="floatingInput">Nominal Uang</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nominal Uang
                                                </div>
                                            </div>
                                        </div>
                                </div>



                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button name="bayar_validate" type="submit" class="btn btn-primary" value="12345">Bayar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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
                                <th scope="col">Aksi</th>
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
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-warning btn-sm me-1 <?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : 'btn btn-warning'?> " data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row['id_list_order'] ?>"><i class="fa-regular fa-pen-to-square"></i></button>
                                            
                                            <button type="button" class="btn btn-danger btn-sm me-1 <?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : 'btn btn-danger'?>" data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $row['id_list_order'] ?>"><i class="fa-regular fa-trash-can"></i></button>
                                        </div>
                                    </td>
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
            <div>
                <button class="btn btn-success <?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : 'btn btn-success'?>" data-bs-toggle="modal" data-bs-target="#tambahItem"><i class="fa-solid fa-circle-plus me-2"></i>Tambah Barang</button>

                <button class="btn btn-primary <?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : 'btn btn-primary'?>" data-bs-toggle="modal" data-bs-target="#bayar"><i class="fa-solid fa-dollar-sign me-2"></i>Bayar</button>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->