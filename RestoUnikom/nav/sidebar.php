<div class="col-lg-3">
    <nav class="navbar navbar-expand-lg bg-light rounded border mt-2">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width: 250px;">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Resto<b>Unikom</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo ((isset($_GET['x']) && $_GET['x'] == 'home') || !isset($_GET['x'])) ? 'active link-light' : 'link=dark' ; ?> " aria-current="page" href="home"><i class="fa-solid fa-house me-2"></i>Beranda</a>
                        </li>

                        <?php if($hasil['level']==1 ){ ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'menu') ? 'active link-light' : 'link=dark' ; ?>" href="menu"><i class="fa-solid fa-bowl-food me-2"></i>Daftar Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'katmenu') ? 'active link-light' : 'link=dark' ; ?>" href="katmenu"><i class="fa-solid fa-tag me-2"></i>Kategori Menu</a>
                        </li>
                        <?php } ?>

                        <?php if($hasil['level']!=4){ ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'order') ? 'active link-light' : 'link=dark' ; ?>" href="order"><i class="fa-solid fa-cart-shopping me-2"></i>Pesanan</a>
                        </li>
                        <?php } ?>

                        <?php if($hasil['level']==1 || $hasil['level']==4){ ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'customer') ? 'active link-light' : 'link=dark' ; ?>" href="dapur"><i class="fa-solid fa-fire-burner me-2"></i>Dapur</a>
                        </li>
                        <?php } ?>

                        <?php if($hasil['level']==1){ ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'user') ? 'active link-light' : 'link=dark' ; ?>" href="user"><i class="fa-regular fa-user me-2"></i>User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'report') ? 'active link-light' : 'link=dark' ; ?>" href="report"><i class="fa-solid fa-chart-simple me-2"></i>Report</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>