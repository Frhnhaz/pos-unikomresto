<?php
include 'proses/connect.php';
$query = mysqli_query($conn, "SELECT * FROM tb_menu
        LEFT JOIN tb_kategori_menu ON tb_kategori_menu.id_kat_menu = tb_menu.kategori");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu, kategori_menu FROM tb_kategori_menu");

?>

<!-- content -->
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header text-center">
            <h3>Daftar Menu</h3> 
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd">Tambah Menu</button>
                </div>
            </div>

            <!-- Modal tambah menu -->
            <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="proses/proses_input_menu.php" method="post" enctype="multipart/form-data" novalidate>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3">
                                            <input name="foto" type="file" class="form-control py-3" id="uploadFoto" required>
                                            <label class="input-group-text" for="uploadFoto">Upload Foto Menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan foto.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input name="nama_menu" type="text" class="form-control" id="floatingInput" placeholder="Nama Menu" required>
                                            <label for="floatingInput">Nama Menu</label>
                                            <div class="invalid-feedback">
                                                Isi nama menu!
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input name="keterangan" type="text" class="form-control" id="floatingPassword" placeholder="Keterangan">
                                            <label for="floatingPassword">Keterangan</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select name="kat_menu" class="form-select" id="floatingSelect" aria-label="Floating label select example" required>
                                                <option value="" selected hidden>Pilih Kategori Menu</option>
                                                <?php
                                                foreach ($select_kat_menu as $value) {
                                                    echo "<option value=" .$value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingSelect">Pilih Kategori Menu</label>
                                            <div class="invalid-feedback">
                                                Pilih kategori Menu.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input name="harga" type="number" class="form-control" id="floatingInput" placeholder="Harga" required>
                                            <label for="floatingInput">Harga</label>
                                            <div class="invalid-feedback">
                                                Masukkan Harga.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button name="input_menu_validate" type="submit" class="btn btn-primary" value="12345">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal View Menu -->
            
            <?php
            if (empty($result)) {
                echo "Data Menu tidak ada";
            } else { 
            foreach ($result as $row) { 
                ?>
            <div class="modal fade" id="modalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="proses/proses_input_menu.php" method="post" enctype="multipart/form-data" novalidate>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="<?php echo $row['nama_menu'] ?> " disabled>
                                            <label for="floatingInput">Nama Menu</label>
                                            <div class="invalid-feedback">
                                                Isi nama menu!
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingPassword" value="<?php echo $row['keterangan'] ?>" disabled>
                                            <label for="floatingPassword">Keterangan</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" disabled >
                                                <option value="" selected hidden>Pilih Kategori Menu</option>
                                                <?php
                                                foreach ($select_kat_menu as $value) {
                                                    if($row['kategori']==$value['id_kat_menu']){
                                                        echo "<option selected value=" .$value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                    }else{
                                                        echo "<option value=" .$value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                    } 
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingSelect">Pilih Kategori Menu</label>
                                            <div class="invalid-feedback">
                                                Pilih kategori Menu.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" value="<?php echo $row['harga'] ?>" disabled>
                                            <label for="floatingInput">Harga</label>
                                            <div class="invalid-feedback">
                                                Masukkan Harga.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal edit menu -->
            <div class="modal fade" id="modalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="proses/proses_edit_menu.php" method="post" enctype="multipart/form-data" novalidate>
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3">
                                            <input name="foto" type="file" class="form-control py-3" id="uploadFoto">
                                            <label class="input-group-text" for="uploadFoto">Upload Foto Menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan foto.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input name="nama_menu" type="text" class="form-control" id="floatingInput" placeholder="Nama Menu" value="<?php echo $row['nama_menu'] ?> " required>
                                            <label for="floatingInput">Nama Menu</label>
                                            <div class="invalid-feedback">
                                                Isi nama menu!
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input name="keterangan" type="text" class="form-control" id="floatingPassword" placeholder="Keterangan" value="<?php echo $row['keterangan'] ?>">
                                            <label for="floatingPassword">Keterangan</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="kat_menu" >
                                                <option value="" selected hidden>Pilih Kategori Menu</option>
                                                <?php
                                                foreach ($select_kat_menu as $value) {
                                                    if($row['kategori']==$value['id_kat_menu']){
                                                        echo "<option selected value=" .$value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                    }else{
                                                        echo "<option value=" .$value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                    } 
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingSelect">Pilih Kategori Menu</label>
                                            <div class="invalid-feedback">
                                                Pilih kategori Menu.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input name="harga" type="number" class="form-control" id="floatingInput" placeholder="Harga" value="<?php echo $row['harga'] ?>" required>
                                            <label for="floatingInput">Harga</label>
                                            <div class="invalid-feedback">
                                                Masukkan Harga.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button name="input_menu_validate" type="submit" class="btn btn-primary" value="12345">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal delete menu -->
            <div class="modal fade" id="modalDelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_delete_menu.php" method="post" novalidate>
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <input type="hidden" value="<?php echo $row['foto'] ?>" name="foto">
                                    <div class="col-lg-12">
                                        Apakah Anda ingin menghapus menu <b><?php echo $row['nama_menu'] ?></b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button name="input_user_validate" type="submit" class="btn btn-danger" value="12345">Hapus</button>
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
                                <th scope="col">Foto Menu</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Jenis Menu</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
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
                                    <td>
                                        <div style="width: 90px;">
                                            <img src="assets/img/<?php echo $row['foto'] ?>" class="img-thumbnail" alt="...">
                                        </div>
                                    </td>
                                    <td><?php echo $row['nama_menu'] ?></td>
                                    <td><?php echo $row['keterangan'] ?></td>
                                    <td><?php echo ($row['jenis_menu']) == 1 ? "Makanan" : "Minuman" ?></td>
                                    <td><?php echo $row['kategori_menu'] ?></td>
                                    <td><?php echo $row['harga'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $row['id'] ?>"><i class="fa-regular fa-eye"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row['id'] ?>"><i class="fa-regular fa-pen-to-square"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $row['id'] ?>"><i class="fa-regular fa-trash-can"></i></button>
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