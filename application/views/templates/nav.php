<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="<?= base_url() ?>asset/css/stylee.css">

    <title>PPID Kota Banjar</title>
</head>

<body>

    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light  fixed-top   ">
        <div class="container">
            <a class="navbar-brand fs-4 fw-bolder txt" href="#" style="color: blue;">PPID Banjar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link active fw-blod fs-6" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-blodernfs-6" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Alur
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Permohonan Informasi</a></li>
                            <li><a class="dropdown-item" href="#">Pengajuan Keberatan</a></li>
                            <li>
                            <li><a class="dropdown-item" href="#">Penyelesain sengketa</a></li>
                            <li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-blod fs-6" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            PPID
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">PPID Utama</a></li>
                            <li><a class="dropdown-item" href="#">PPID Pembantu</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-blod fs-6" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Informasi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Informasi Berkala</a></li>
                            <li><a class="dropdown-item" href="#">Informasi Setiap Sesaat</a></li>
                            <li><a class="dropdown-item" href="#">Informasi Serta Merta</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fs-6 fw-blod" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Jenis Dokumen
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Profil Badan Publik</a></li>
                            <li><a class="dropdown-item" href="#">Program dan Kegiatan</a></li>
                            <li><a class="dropdown-item" href="#">Informasi Kinerja</a></li>
                            <li><a class="dropdown-item" href="#">Laporan Keuangan</a></li>
                            <li><a class="dropdown-item" href="#">Laoran dan Prosedur Akses Informasi</a></li>
                            <li><a class="dropdown-item" href="#">Pengaduan dan Pelanggaran</a></li>
                            <li><a class="dropdown-item" href="#">Pengadaan Barang dan Jasa</a></li>
                            <li><a class="dropdown-item" href="#">Informasi Darurat</a></li>
                            <li><a class="dropdown-item" href="#">Hasil Penelitian</a></li>
                            <li><a class="dropdown-item" href="#">Regulasi</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <a href="<?= base_url('auth/login'); ?>"><button class="btn btn-sm btn-outline-primary">Masuk</button></a>
                </ul>

            </div>
        </div>
    </nav>
    <!-- nav -->