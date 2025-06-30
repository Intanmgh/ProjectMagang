<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Tanjungenim Lestari Pulp and Paper</title>
    <!-- Link ke file CSS utama Anda jika ada app.css terpisah -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Variabel Warna Dasar Website */
        :root {
            --primary-green: #388e3c; /* Hijau yang digunakan untuk header dan sidebar */
            --dark-green-sidebar: #306932; /* Hijau gelap untuk sidebar */
            --text-white: #ffffff;
            --text-light-grey: #e0e0e0; /* Untuk teks di sidebar */
            --card-bg-green: #4caf50; /* Hijau untuk background card seperti di gambar */
            --shadow-color: rgba(0, 0, 0, 0.1);
            --shadow-color-hover: rgba(0, 0, 0, 0.2);
            --border-radius-lg: 15px; /* Untuk sudut card yang melengkung */
            --border-radius-sm: 8px; /* Untuk elemen yang lebih kecil */

            /* Variabel Warna Tambahan untuk Tabel CRUD dan Tab */
            --primary-blue: #007bff; /* Biru untuk tombol Tambah Transaksi */
            --primary-blue-hover: #0056b3;
            --border-color: #e0e0e0; /* Warna border untuk tabel dan input */
            --header-bg-grey: #f8f9fa; /* Background header tabel */
            --table-row-hover-bg: #f5f5f5; /* Background baris saat hover */
            --pagination-active-bg: #007bff; /* Background tombol pagination aktif */
            --pagination-active-color: #fff;
            --pagination-border-color: #dee2e6;
            --table-header-color: #495057; /* Warna teks header tabel */

            --tab-inactive-bg: #e9ecef; /* Warna latar belakang tab tidak aktif */
            --tab-active-bg: #ffffff; /* Warna latar belakang tab aktif */
            --tab-border: #dee2e6; /* Warna border tab */
            --tab-active-border-bottom: #ffffff; /* Warna border bawah tab aktif */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5; /* Latar belakang body sedikit abu-abu */
            display: flex;
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        /* Header */
        .dashboard-header {
            background-color: var(--primary-green);
            color: var(--text-white);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px var(--shadow-color);
        }

        .logo-section {
            display: flex;
            align-items: center;
        }

        .company-logo {
            height: 40px; /* Sesuaikan ukuran logo */
            margin-right: 15px;
        }

        .dashboard-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: normal;
        }

        .operator-section {
            display: flex;
            align-items: center;
        }

        .operator-text {
            margin-right: 10px;
            font-size: 16px;
        }

        .user-icon {
            height: 25px; /* Sesuaikan ukuran ikon user */
            border-radius: 50%; /* Jika ikon user adalah gambar bulat */
            margin-right: 5px;
        }

        .operator-section .fas.fa-caret-down {
            color: var(--text-white);
            font-size: 14px;
        }

        /* Main Content Wrapper */
        .main-content-wrapper {
            display: flex;
            flex-grow: 1; /* Memungkinkan konten utama mengisi sisa ruang */
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--dark-green-sidebar);
            color: var(--text-light-grey);
            padding-top: 20px;
            box-shadow: 2px 0 5px var(--shadow-color);
            flex-shrink: 0; /* Mencegah sidebar menyusut */
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin-bottom: 5px;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-light-grey);
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a i {
            margin-right: 10px;
            font-size: 18px;
        }

        .sidebar ul li.active a,
        .sidebar ul li a:hover {
            background-color: var(--primary-green); /* Warna highlight saat aktif/hover */
            color: var(--text-white);
        }

        /* Main Content Area (untuk mengisi konten dinamis) */
        .content-area {
            flex-grow: 1; /* Memastikan area konten mengisi ruang */
            padding: 20px; /* Padding di sekitar konten tabel */
            background-color: #f0f2f5; /* Latar belakang abu-abu muda */
        }


        /* Styling untuk Kartu Dashboard */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Responsif */
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .info-card {
            background-color: var(--card-bg-green);
            color: var(--text-white);
            border-radius: var(--border-radius-lg);
            box-shadow: 0 4px 8px var(--shadow-color);
            padding: 20px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 120px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .info-card-link:hover .info-card {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px var(--shadow-color-hover);
        }

        .info-card .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .card-image-icon {
            width: 60px;
            height: 60px;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .info-card .card-title {
            font-size: 22px;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
            flex-grow: 1;
        }

        .info-card .card-description {
            font-size: 14px;
            margin-top: 5px;
            line-height: 1.5;
            opacity: 0.9;
        }

        .arrow-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 20px;
            color: var(--text-white);
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
            z-index: 5;
        }

        .info-card-link:hover .arrow-icon {
            transform: translateX(5px);
        }

        /* Notifikasi Card */
        .notifications-card {
            background-color: var(--text-white);
            color: #333;
            border-radius: var(--border-radius-lg);
            box-shadow: 0 4px 8px var(--shadow-color);
            padding: 20px;
            position: relative;
        }

        .notifications-card .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .notifications-card .card-image-icon {
            width: 25px;
            height: 25px;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .notifications-card .card-title {
            font-size: 20px;
            font-weight: bold;
            flex-grow: 1;
        }

        .notifications-card .arrow-icon {
            position: static;
            margin-left: auto;
            color: #555;
            cursor: pointer;
            font-size: 20px;
        }

        .notifications-card .arrow-icon:hover {
            transform: translateX(3px);
        }

        .notification-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .notification-list li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
            font-size: 15px;
        }

        .notification-list li:last-child {
            margin-bottom: 0;
        }

        .notification-icon {
            font-size: 20px;
            margin-right: 10px;
            width: 25px;
            text-align: center;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .notification-icon.red { color: #f44336; }
        .notification-icon.blue { color: #2196f3; }
        .notification-icon.orange { color: #ff9800; }

        .notification-text {
            flex-grow: 1;
            line-height: 1.4;
        }

        .notification-time {
            font-size: 13px;
            color: #888;
            margin-left: 10px;
            white-space: nowrap;
            flex-shrink: 0;
        }


        /* Styling untuk Tabel CRUD (Konten Halaman) */
        /* Ini akan digunakan di barang_manajemen/index.blade.php */

        .breadcrumb-container {
            display: flex;
            justify-content: flex-end;
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 20px;
        }
        .breadcrumb-item {
            margin-left: 5px;
        }
        .breadcrumb-item.active {
            font-weight: bold;
            color: #333;
        }

        .page-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 25px;
        }

        .table-card {
            background-color: #fff;
            border-radius: var(--border-radius-lg);
            box-shadow: 0 4px 8px var(--shadow-color);
            padding: 25px;
        }

        .table-header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-header-title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        .btn-add-transaction {
            background-color: var(--primary-blue);
            color: var(--text-white);
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius-sm);
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        .btn-add-transaction:hover {
            background-color: var(--primary-blue-hover);
        }
        .btn-add-transaction .fas {
            margin-right: 8px;
        }

        .table-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-controls-left, .table-controls-right {
            display: flex;
            align-items: center;
        }

        .table-controls label {
            margin-right: 10px;
            font-size: 14px;
            color: #555;
        }

        .table-controls select, .table-controls input[type="search"] {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s ease;
        }
        .table-controls select:focus, .table-controls input[type="search"]:focus {
            border-color: var(--primary-blue);
        }

        .table-controls input[type="search"] {
            margin-left: 10px;
            width: 200px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
            color: #333;
        }

        .data-table th {
            background-color: var(--header-bg-grey);
            font-weight: bold;
            color: var(--table-header-color);
            text-transform: uppercase;
        }

        .data-table tbody tr:hover {
            background-color: var(--table-row-hover-bg);
        }

        .pagination-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .pagination-info {
            font-size: 14px;
            color: #555;
        }

        .pagination-controls {
            display: flex;
        }

        .pagination-controls a, .pagination-controls span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 35px;
            height: 35px;
            padding: 0 10px;
            margin-left: -1px;
            border: 1px solid var(--pagination-border-color);
            text-decoration: none;
            color: #007bff;
            transition: all 0.2s ease;
        }
        .pagination-controls a:first-child {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }
        .pagination-controls a:last-child {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .pagination-controls a:hover {
            background-color: var(--table-row-hover-bg);
            color: var(--primary-blue);
        }

        .pagination-controls span.current {
            background-color: var(--pagination-active-bg);
            color: var(--pagination-active-color);
            border-color: var(--pagination-active-bg);
            font-weight: bold;
            z-index: 1;
        }
        .pagination-controls span.disabled {
            color: #6c757d;
            cursor: not-allowed;
            background-color: #e9ecef;
        }

        /* Styling untuk Tab */
        .tab-container {
            margin-top: 20px;
            background-color: var(--tab-active-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: 0 4px 8px var(--shadow-color);
            overflow: hidden; /* Penting untuk rounded corners */
        }

        .tab-headers {
            display: flex;
            border-bottom: 1px solid var(--tab-border);
            background-color: var(--tab-inactive-bg);
            border-top-left-radius: var(--border-radius-lg);
            border-top-right-radius: var(--border-radius-lg);
        }

        .tab-header {
            padding: 15px 25px;
            cursor: pointer;
            font-weight: bold;
            color: #555;
            transition: background-color 0.3s ease, color 0.3s ease;
            border-right: 1px solid var(--tab-border); /* Pemisah antar tab */
            border-bottom: 3px solid transparent; /* Untuk indikator aktif */
            text-align: center;
            flex-grow: 1; /* Agar tab mengisi lebar */
        }
        .tab-header:last-child {
            border-right: none; /* Hapus border kanan pada tab terakhir */
        }

        .tab-header.active {
            background-color: var(--tab-active-bg);
            color: var(--primary-green);
            border-bottom: 3px solid var(--primary-green); /* Indikator aktif */
            border-right-color: transparent; /* Hilangkan border kanan di bawah tab aktif */
        }
        .tab-header:hover:not(.active) {
            background-color: #f0f0f0;
        }

        .tab-content {
            padding: 25px;
            display: none; /* Sembunyikan semua konten tab secara default */
        }

        .tab-content.active {
            display: block; /* Tampilkan konten tab yang aktif */
        }

        /* Styling Form di dalam Tab */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="date"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box; /* Pastikan padding tidak menambah lebar */
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="number"]:focus,
        .form-group input[type="date"]:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: var(--primary-blue);
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-submit {
            background-color: var(--primary-green);
            color: var(--text-white);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #28a745; /* Sedikit lebih gelap */
        }

        .btn-action-edit, .btn-action-delete {
            background-color: #ffc107; /* Kuning untuk edit */
            color: #333;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 13px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-right: 5px;
        }
        .btn-action-edit:hover {
            background-color: #e0a800;
        }
        .btn-action-delete {
            background-color: #dc3545; /* Merah untuk delete */
            color: var(--text-white);
        }
        .btn-action-delete:hover {
            background-color: #c82333;
        }
        .btn-action-edit .fas, .btn-action-delete .fas {
            margin-right: 5px;
        }


        /* Responsivitas umum */
        @media (max-width: 768px) {
            .main-content-wrapper {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                padding-top: 0;
            }
            .sidebar ul {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                padding-bottom: 10px;
            }
            .sidebar ul li a {
                padding: 10px 15px;
                font-size: 14px;
            }
            .company-logo {
                height: 30px;
            }
            .dashboard-header h1 {
                font-size: 18px;
            }
            .operator-text {
                font-size: 14px;
            }
            .user-icon {
                height: 20px;
            }

            /* Responsivitas untuk tabel */
            .table-controls {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            .table-controls input[type="search"] {
                margin-left: 0;
                width: 100%;
            }
            .table-controls-right {
                width: 100%;
                justify-content: flex-end;
            }
            .table-header-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            .page-title {
                font-size: 24px;
                margin-bottom: 20px;
            }
            .table-card {
                padding: 15px;
            }
            .data-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            .data-table thead, .data-table tbody, .data-table th, .data-table td, .data-table tr {
                display: block;
            }
            .data-table thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            .data-table tr {
                border: 1px solid var(--border-color);
                margin-bottom: 10px;
                border-radius: var(--border-radius-sm);
            }
            .data-table td {
                border: none;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }
            .data-table td:before {
                content: attr(data-label);
                position: absolute;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
                color: var(--table-header-color);
            }
            .pagination-section {
                flex-direction: column;
                gap: 15px;
            }
            /* Responsivitas Tab */
            .tab-headers {
                flex-direction: column;
            }
            .tab-header {
                border-right: none;
                border-bottom: 1px solid var(--tab-border);
            }
            .tab-header.active {
                border-bottom: 3px solid var(--primary-green);
            }
        }

        @media (max-width: 480px) {
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .operator-section {
                margin-top: 10px;
            }
            .cards-grid {
                grid-template-columns: 1fr;
            }
            .info-card .card-title, .notifications-card .card-title {
                font-size: 18px;
            }
            .card-image-icon {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>
<!-- <body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <div class="logo-section">
                <img src="{{ asset('images/logo.png') }}" alt="Logo TPL" class="company-logo">
                <h1>PT TANJUNGENIM LESTARI PULP AND PAPER</h1>
            </div>
            <div class="operator-section">
                <span class="operator-text">Operator</span>
                <img src="{{ asset('images/user.png') }}" alt="User Icon" class="user-icon">
                <i class="fas fa-caret-down"></i>
            </div>
        </header>

        <div class="main-content-wrapper">
            <aside class="sidebar">
                <nav>
                    <ul>
                        <li class="menu-item active">
                            <a href="{{ url('/dashboard') }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ url('/barang-manajemen') }}"> {{-- Link ke halaman Manajemen Barang Gabungan --}}
                                Manajemen Barang
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                Data Barang
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                Pengembalian
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                Notifications
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <main class="dashboard-main-content">
                <div class="content-area">
                    @yield('content') {{-- Konten halaman spesifik akan dirender di sini --}}
                </div>
            </main>
        </div>
    </div> -->

    <!-- PENTING: Ganti 'YOUR_UNIQUE_KIT_CODE.js' dengan ID kit Font Awesome Anda! -->
    <script src="https://kit.fontawesome.com/YOUR_UNIQUE_KIT_CODE.js" crossorigin="anonymous"></script>
    @stack('scripts') {{-- Untuk script JS tambahan dari child views --}}
</body>
</html>
