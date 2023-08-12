<?php
include './proses/connect.php';
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$_SESSION[username_resto]' ");
$records = mysqli_fetch_array($query);
?>

<nav class="navbar navbar-expand navbar-dark bg-primary sticky-top">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand" href=".">Resto<b>Unikom</b></a>
        <!-- End Brand -->

        <!-- Profile -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $records['nama']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalProfile"><i class="fa-solid fa-circle-user me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalUbahPass"><i class="fa-solid fa-key me-2"></i>Ubah Password</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="fa-solid fa-right-from-bracket me-2"></i>Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- End Profile -->
    </div>
</nav>

<!-- Modal ubah password -->
<div class="modal fade" id="modalUbahPass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="proses/proses_ubah_password.php" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="id" value="<?php echo $records['id'] ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input name="username" type="email" class="form-control" id="floatingInput" placeholder="Username" value="<?php echo $_SESSION['username_resto'] ?>" disabled required>
                                <label for="floatingInput">Username</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input name="passwordlama" type="password" class="form-control" id="floatingPassword" required>
                                <label for="floatingPassword">Password Lama</label>
                                <div class="invalid-feedback">
                                    Masukkan Password Lama.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input name="passwordbaru" type="password" class="form-control" id="floatingInput" required>
                                <label for="floatingInput">Password Baru</label>
                                <div class="invalid-feedback">Masukkan Password Baru.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input name="repasswordbaru" type="password" class="form-control" id="floatingInput" required>
                                <label for="floatingInput">Ulangi Password baru </label>
                                <div class="invalid-feedback">Ulangi Password Baru.</div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button name="ubah_password_validate" type="submit" class="btn btn-primary" name="ubah_password_validate" value="12345">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah Profile -->
<div class="modal fade" id="modalProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="proses/proses_ubah_profile.php" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="id" value="<?php echo $records['id'] ?>">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input name="username" type="email" class="form-control" id="floatingInput" placeholder="Username" value="<?php echo $_SESSION['username_resto'] ?>" disabled>
                                <label for="floatingInput">Username</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input name="nama" type="text" class="form-control" id="floatingName" value="<?php echo $records['nama'] ?>" required>
                                <label for="floatingName">Nama</label>
                                <div class="invalid-feedback">
                                    Masukkan nama anda.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input name="nohp" type="number" min="0" class="form-control" id="floatingInput" value="<?php echo $records['nohp'] ?>" required>
                                <label for="floatingInput">Nomor HP</label>
                                <div class="invalid-feedback">Masukkan no HP Anda.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-floating">
                            <textarea class="form-control" name="alamat" id="alamat"><?php echo $records['alamat'] ?></textarea>
                            <label for="FloatingInput">Alamat</label>
                            <div class="invalid-feedback">Masukkan alamat Anda.</div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button name="ubah_profile_validate" type="submit" class="btn btn-primary" name="ubah_profile_validate" value="12345">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>