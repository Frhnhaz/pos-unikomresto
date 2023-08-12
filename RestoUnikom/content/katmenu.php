<?php
include 'proses/connect.php';
$query = mysqli_query($conn, "SELECT * FROM tb_kategori_menu");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<!-- content -->
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header text-center">
            <h3>Daftar Kategori Menu</h3> 
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd">Tambah Kategori</button>
                </div>
            </div>

            <!-- Modal tambah kategori -->
            <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="proses/proses_input_katmenu.php" method="post" novalidate>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <select name="jenismenu" class="form-select" id="">
                                                <option value="1">Makanan</option>
                                                <option value="2">Minuman</option>
                                            </select>
                                            <label for="floatingInput">Jenis Menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan Jenis Menu.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input name="katmenu" type="text" class="form-control" id="floatingInput" placeholder="Kategori Menu" required>
                                            <label for="floatingInput">Kategori Menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan Kategori Menu.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button name="input_katmenu_validate" type="submit" class="btn btn-primary" value="12345">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (empty($result)) {
                echo "Data kategori tidak ada";
            } else {
                foreach ($result as $row) { ?>

                    <!-- Modal edit user -->
                    <div class="modal fade" id="modalEdit<?php echo $row['id_kat_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_edit_katmenu.php" method="post" novalidate>
                                        <input type="hidden" name="id" value="<?php echo $row['id_kat_menu'] ?>">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <select name="jenismenu" id="" class="form-select" aria-label="Default select example" required>
                                                        <?php
                                                        $data = array("Makanan", "Minuman");
                                                        foreach ($data as $key => $value) {
                                                            if ($row['jenismenu'] == $key + 1) {
                                                                echo "<option selected value=" . ($key + 1) . ">$value</option>";
                                                            } else {
                                                                echo "<option value=" . ($key + 1) . ">$value</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingInput">Jenis Menu</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Jenis Menu.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input name="katmenu" type="text" class="form-control" id="floatingInput" placeholder="Kategori Menu" required value="<?php echo $row['kategori_menu'] ?>">
                                                    <label for="floatingInput">Kategori Menu</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Kategori Menu.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button name="input_katmenu_validate" type="submit" class="btn btn-primary" value="12345">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal delete user -->
                    <div class="modal fade" id="modalDelete<?php echo $row['id_kat_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Kategori</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_delete_katmenu.php" method="post" novalidate>
                                        <input type="hidden" value="<?php echo $row['id_kat_menu'] ?>" name="id">
                                        <div class="col-lg-12">
                                            Apakah anda ingin menghapus kategori <b><?php echo $row['kategori_menu'] ?></b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button name="hapus_kategori_validate" type="submit" class="btn btn-danger"  value="12345">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <!-- Tabel -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jenis Menu</th>
                                <th scope="col">Kategori Menu</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo ($row['jenis_menu'] == 1) ? "Makanan" : "Minuman" ?></td>
                                    <td><?php echo $row['kategori_menu'] ?></td>
                                    <td class="d-flex">
                                        <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row['id_kat_menu'] ?>"><i class="fa-regular fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $row['id_kat_menu'] ?>"><i class="fa-regular fa-trash-can"></i></button>
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