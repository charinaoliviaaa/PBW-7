<?php
session_start();
require_once 'koneksi.php';
require_once 'mahasiswa.php';
require_once 'matakuliah.php';
require_once 'krs.php';

function tampilkanFormTambahKRS() {
    formKRS('tambah');
}

function tampilkanFormEditKRS($id) {
    formKRS('edit', $id);
}

function tampilkanFormTambahMahasiswa() {
    formMahasiswa('tambah');
}

function tampilkanFormEditMahasiswa($npm) {
    formMahasiswa('edit', $npm);
}

function tampilkanFormTambahMatakuliah() {
    formMatakuliah('tambah');
}

function tampilkanFormEditMatakuliah($kodemk) {
    formMatakuliah('edit', $kodemk);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi KRS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="nav-container">
            <div class="menu-container">
                <?php 
                $pages = [
                    'krs' => ['icon' => 'list-alt', 'text' => 'Data KRS'],
                    'mahasiswa' => ['icon' => 'users', 'text' => 'Data Mahasiswa'],
                    'matakuliah' => ['icon' => 'book', 'text' => 'Data Mata Kuliah']
                ];
                foreach ($pages as $key => $value) {
                    $active = (!isset($_GET['page']) && $key == 'krs') || (isset($_GET['page']) && $_GET['page'] == $key) ? 'active' : '';
                    echo "<a href='index.php?page=$key' class='menu-button $active'>
                            <i class='fas fa-{$value['icon']}'></i> {$value['text']}
                          </a>";
                }
                ?>
            </div>
        </div>

        <?php
        $page = $_GET['page'] ?? 'krs';
        $action = $_GET['action'] ?? 'list';
        
        $titles = [
            'krs' => ['list-alt', 'text' => 'Daftar KRS'],
            'mahasiswa' => ['users', 'text' => 'Data Mahasiswa'],
            'matakuliah' => ['book', 'text' => 'Data Mata Kuliah']
        ];
        
        $buttons = [
            'krs' => 'Tambah Data KRS',
            'mahasiswa' => 'Tambah Mahasiswa',
            'matakuliah' => 'Tambah Mata Kuliah'
        ];
        
        echo "<div class='page-header'>
                <h1 class='page-title'>{$titles[$page]['text']}</h1>
                <div class='action-container'>";
        
        if ($action == 'list') {
            echo "<a href='index.php?page=$page&action=tambah' class='add-button'>
                    <i class='fas fa-plus'></i> {$buttons[$page]}
                  </a>";
        }
        
        echo "</div></div>";
        
        switch ($page) {
            case 'krs':
                switch ($action) {
                    case 'list': tampilkanKRS(); break;
                    case 'tambah': tampilkanFormTambahKRS(); break;
                    case 'edit': $id = $_GET['id'] ?? ''; tampilkanFormEditKRS($id); break;
                    case 'hapus': $id = $_GET['id'] ?? ''; prosesHapusKRS($id); break;
                    case 'save': prosesKRS(); break;
                    default: tampilkanKRS();
                }
                break;
            case 'mahasiswa':
                switch ($action) {
                    case 'list': tampilkanMahasiswa(); break;
                    case 'tambah': tampilkanFormTambahMahasiswa(); break;
                    case 'edit': $npm = $_GET['npm'] ?? ''; tampilkanFormEditMahasiswa($npm); break;
                    case 'hapus': $npm = $_GET['npm'] ?? ''; prosesHapusMahasiswa($npm); break;
                    case 'save': prosesMahasiswa(); break;
                    default: tampilkanMahasiswa();
                }
                break;
            case 'matakuliah':
                switch ($action) {
                    case 'list': tampilkanMatakuliah(); break;
                    case 'tambah': tampilkanFormTambahMatakuliah(); break;
                    case 'edit': $kodemk = $_GET['kodemk'] ?? ''; tampilkanFormEditMatakuliah($kodemk); break;
                    case 'hapus': $kodemk = $_GET['kodemk'] ?? ''; prosesHapusMatakuliah($kodemk); break;
                    case 'save': prosesMatakuliah(); break;
                    default: tampilkanMatakuliah();
                }
                break;
            default:
                echo '<div class="alert alert-danger">Halaman tidak ditemukan!</div>';
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
