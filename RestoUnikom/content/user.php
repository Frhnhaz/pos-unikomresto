<?php
include 'proses/connect.php';
$query = mysqli_query($conn, "SELECT * FROM tb_user");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<!-- content -->
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header text-center">
            <h3>Daftar Pengguna</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Tambah Pengguna</button>
                </div>
            </div>

            <!-- Modal tambah user -->
            <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengguna</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="proses/proses_input_user.php" method="post" novalidate>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input name="nama" type="text" class="form-control" id="floatingInput" placeholder="Your name" required>
                                            <label for="floatingInput">Nama</label>
                                            <div class="invalid-feedback">
                                                Nama Belum Terisi.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input name="username" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                                            <label for="floatingInput">Username</label>
                                            <div class="invalid-feedback">
                                                Username Belum Terisi.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select name="level" class="form-select" id="floatingSelect" aria-label="Floating label select example" required>
                                                <option selected hidden value="">Pilih Level User</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Kasir</option>
                                                <option value="3">Pelayan</option>
                                                <option value="4">Dapur</option>
                                            </select>
                                            <label for="floatingSelect">Pilih level user</label>
                                            <div class="invalid-feedback">
                                                Level Belum Dipilih.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <input name="nohp" type="number" class="form-control" id="floatingInput" placeholder="08xxxxxxxxxxxxx">
                                            <label for="floatingInput">No HP</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col--lg-12">
                                        <div class="form-floating mb-3">
                                            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="password" disabled value="12345">
                                            <label for="floatingPassword">Password</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating">
                                    <textarea class="form-control" name="alamat" id="alamat"></textarea>
                                    <label for="FloatingInput">Alamat</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button name="input_user_validate" type="submit" class="btn btn-primary" value="12345">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal view user -->
            <?php foreach ($result as $row) { ?>
                <div class="modal fade" id="modalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Informasi Pengguna</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_input_user.php" method="post" novalidate>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input name="nama" type="text" class="form-control" id="floatingInput" placeholder="Your name" value="<?php echo $row['nama'] ?>" disabled>
                                                <label for="floatingInput">Nama</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input name="username" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $row['username'] ?>" disabled>
                                                <label for="floatingInput">Username</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select disabled name="level" id="" class="form-select" aria-label="Default select example" required>
                                                    <?php
                                                    $data = array("Admin", "Kasir", "Pelayan", "Dapur");
                                                    foreach ($data as $key => $value) {
                                                        if ($row['level'] == $key + 1) {
                                                            echo "<option selected value='$key'>$value</option>";
                                                        } else {
                                                            echo "<option value='$key'>$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Pilih Level Pengguna</label>
                                                <div class="invalid-feedback">
                                                    Level Belum Dipilih.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <input name="nohp" type="number" class="form-control" id="floatingInput" placeholder="08xxxxxxxxxxxxx" disabled value="<?php echo $row['nohp'] ?>">
                                                <label for="floatingInput">No HP</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-floating">
                                        <textarea class="form-control" name="alamat" id="alamat" disabled><?php echo $row['alamat'] ?></textarea>
                                        <label for="FloatingInput">Alamat</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal edit user -->
                <div class="modal fade" id="modalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_edit_user.php" method="post" novalidate>
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input name="nama" type="text" class="form-control" id="floatingInput" placeholder="Your name" required value="<?php echo $row['nama'] ?>">
                                                <label for="floatingInput">Nama</label>
                                                <div class="invalid-feedback">
                                                    Nama Belum Terisi.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input <?php echo ($row['username'] == $_SESSION['username_resto']) ? 'disabled' : '';  ?> name="username" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $row['username'] ?>">
                                                <label for="floatingInput">Username</label>
                                                <div class="invalid-feedback">
                                                    Username Belum Terisi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select name="level" id="" class="form-select" aria-label="Default select example" required>
                                                    <?php
                                                    $data = array("Admin", "Kasir", "Pelayan", "Dapur");
                                                    foreach ($data as $key => $value) {
                                                        if ($row['level'] == $key + 1) {
                                                            echo "<option selected value=" . ($key + 1) . ">$value</option>";
                                                        } else {
                                                            echo "<option value=" . ($key + 1) . ">$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Pilih Level User</label>
                                                <div class="invalid-feedback">
                                                    Level Belum Dipilih.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <input name="nohp" type="number" class="form-control" id="floatingInput" placeholder="08xxxxxxxxxxxxx" value="<?php echo $row['nohp'] ?>">
                                                <label for="floatingInput">No HP</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-floating">
                                        <textarea class="form-control" name="alamat" id="alamat"><?php echo $row['alamat'] ?></textarea>
                                        <label for="FloatingInput">Alamat</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button name="edit_user_validate" type="submit" class="btn btn-primary" value="12345">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal delete user -->
                <div class="modal fade" id="modalDelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pengguna</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_delete_user.php" method="post" novalidate>
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="col-lg-12">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_resto']) {
                                            echo "<div class='alert alert-danger'>Anda tidak dapat menghapus akun sendiri</div>";
                                        } else {
                                            echo "Apakah Anda yakin ingin menghapus user <b> $row[username]</b>?";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button name="input_user_validate" type="submit" class="btn btn-danger" <?php
                                                                                                                echo ($row['username'] == $_SESSION['username_resto']) ? 'disabled' : '';
                                                                                                                ?> value="12345">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal reset password -->
                <div class="modal fade" id="modalResetPassword<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Kata Sandi Pengguna</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_reset_password.php" method="post" novalidate>
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="col-lg-12">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_resto']) {
                                            echo "<div class='alert alert-danger'>Anda tidak dapat mereset akun sendiri</div>";
                                        } else {
                                            echo "Apakah Anda yakin ingin mereset password user <b> $row[nama]</b> menjadi password bawaan sistem yaitu <b>password</b>?";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button name="input_user_validate" type="submit" class="btn btn-success" <?php
                                                                                                                    echo ($row['username'] == $_SESSION['username_resto']) ? 'disabled' : '';
                                                                                                                    ?> value="12345">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php
            if (empty($result)) {
                echo "Data Pengguna Tidak Ada";
            } else {
            ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Level</th>
                                <th scope="col">No HP</th>
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
                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php
                                        if ($row['level'] == 1) {
                                            echo 'Admin';
                                        } elseif ($row['level'] == 2) {
                                            echo 'Kasir';
                                        } elseif ($row['level'] == 3) {
                                            echo 'Pelayan';
                                        } elseif ($row['level'] == 4) {
                                            echo 'Dapur';
                                        }
                                        ?></td>
                                    <td><?php echo $row['nohp'] ?></td>
                                    <td class="d-flex">
                                        <button type="button" class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $row['id'] ?>"><i class="fa-regular fa-eye"></i></button>
                                        <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row['id'] ?>"><i class="fa-regular fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $row['id'] ?>"><i class="fa-regular fa-trash-can"></i></button>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalResetPassword<?php echo $row['id'] ?>"><i class="fa-solid fa-key"></i></button>
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