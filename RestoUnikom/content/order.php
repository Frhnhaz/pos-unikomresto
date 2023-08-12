<?php
include 'proses/connect.php';
date_default_timezone_set('Asia/Jakarta');

$query = mysqli_query($conn, "SELECT *, SUM(harga * jumlah ) AS harga_total FROM tb_order
        LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
        LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
        LEFT JOIN tb_menu ON tb_menu.id = tb_list_order.menu
        LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
        GROUP BY id_order ORDER BY waktu_order DESC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

?>

<!-- content -->
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header text-center">
           <h3>Daftar Pesanan</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Tambah Pesanan</button>
                </div>
            </div>

            <!-- Modal tambah Order -->
            <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pesanan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="proses/proses_input_order.php" method="post" novalidate>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input name="kode_order" type="text" class="form-control" id="kode_order" value="<?php echo date('ymdHi') . rand(100, 999) ?>" readonly>
                                            <label class="floating-input" for="kode_order">Kode Order</label>
                                            <div class="invalid-feedback">
                                                Masukkan Kode Order.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-floating mb-3">
                                            <input name="meja" type="number" class="form-control" id="meja" placeholder="Meja" min="0" required>
                                            <label for="meja">Meja</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nomor Meja!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-floating mb-3">
                                            <input name="pelanggan" type="text" class="form-control" id="pelanggan" placeholder="Pelanggan" required>
                                            <label for="pealnggan">Nama Pelanggan</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama Pelanggan!
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button name="input_order_validate" type="submit" class="btn btn-primary" value="12345">Buat Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal View Menu -->

            <?php
            if (empty($result)) {
                echo "Data pesanan tidak ada";
            } else {
                foreach ($result as $row) {
            ?>

                    <!-- Modal edit menu -->
                    <div class="modal fade" id="modalEdit<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Pesanan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_edit_order.php" method="post" novalidate>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-floating mb-3">
                                                    <input name="kode_order" type="text" class="form-control" id="kode_order" value="<?php echo $row['id_order'] ?>" readonly>
                                                    <label class="floating-input" for="kode_order">Kode Order</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Kode Order.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-floating mb-3">
                                                    <input name="meja" type="number" class="form-control" id="meja" placeholder="Meja" value="<?php echo $row['meja'] ?>" required>
                                                    <label for="meja">Meja</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan nomor meja!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-floating mb-3">
                                                    <input name="pelanggan" type="text" class="form-control" id="pelanggan" placeholder="Pelanggan" value="<?php echo $row['pelanggan'] ?>" required>
                                                    <label for="pealnggan">Nama Pelanggan</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Nama Pelanggan!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button name="edit_order_validate" type="submit" class="btn btn-primary" value="12345">Simpan</button>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pesanan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_delete_order.php" method="post" novalidate>
                                        <input type="hidden" value="<?php echo $row['id_order'] ?>" name="kode_order">
                                        <div class="col-lg-12">
                                            Apakah anda ingin menghapus order atas nama <b><?php echo $row['pelanggan'] ?></b> dengan kode order <b><?php echo $row['id_order'] ?></b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button name="delete_order_validate" type="submit" class="btn btn-danger" value="12345">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

                <?php

                ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Meja</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Pelayan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Waktu Order</th>
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
                                    <td><?php echo $row['pelanggan'] ?></td>
                                    <td><?php echo $row['meja'] ?></td>
                                    <td><?php echo number_format($row['harga_total'], 0, ".",",")  ?></td>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php echo (!empty($row['id_bayar'])) ? "<span class='badge text-bg-success'>Dibayar</span>" : "<span class='badge text-bg-warning'>Belum Lunas</span>"  ?> </td>
                                    <td><?php echo $row['waktu_order'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-sm btn-info me-1" href="./?x=orderitem&order=<?php echo $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan'] ?>"><i class="fa-regular fa-eye"></i></a>

                                            <button type="button" class="btn btn-warning btn-sm me-1 <?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : 'btn btn-warning'?> " data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row['id_list_order'] ?>"><i class="fa-regular fa-pen-to-square"></i></button>
                                            
                                            <button type="button" class="btn btn-danger btn-sm me-1 <?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : 'btn btn-danger'?>" data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $row['id_list_order'] ?>"><i class="fa-regular fa-trash-can"></i></button>
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