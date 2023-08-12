<?php
session_start();
if (isset($_GET['x']) && $_GET['x'] == 'home') {
    $page = 'content/home.php';
    include 'main.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'order') {
    if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 4) {
        $page = 'content/order.php';
        include 'main.php';
    } else {
        $page = 'content/home.php';
        include 'main.php';
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'user') {
    if ($_SESSION['level_user'] == 1) {
        $page = 'content/user.php';
        include 'main.php';
    } else {
        $page = 'content/home.php';
        include 'main.php';
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'dapur') {
    if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 4) {
        $page = 'content/dapur.php';
        include 'main.php';
    } else {
        $page = 'content/home.php';
        include 'main.php';
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'report') {
    if ($_SESSION['level_user'] == 1) {
        $page = 'content/report.php';
        include 'main.php';
    } else {
        $page = 'content/home.php';
        include 'main.php';
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'menu') {
    if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 3) {
        $page = 'content/menu.php';
        include 'main.php';
    } else {
        $page = 'content/home.php';
        include 'main.php';
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'katmenu') {
    if ($_SESSION['level_user'] == 1) {
        $page = 'content/katmenu.php';
        include 'main.php';
    } else {
        $page = 'content/home.php';
        include 'main.php';
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'orderitem') {
    if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 3) {
        $page = 'content/order_item.php';
        include 'main.php';
    } else {
        $page = 'content/home.php';
        include 'main.php';
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'viewitem') {
    if ($_SESSION['level_user'] == 1) {
        $page = 'content/view_item.php';
        include 'main.php';
    } else {
        $page = 'content/home.php';
        include 'main.php';
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'login') {
    include 'login.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'logout') {
    include 'proses/proses_logout.php';
} else {
    $page = 'content/home.php';
    include 'main.php';
}
