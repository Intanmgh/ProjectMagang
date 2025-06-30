<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Tanjungenim Lestari Pulp and Paper</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Warna-warna dasar yang digunakan pada gambar */
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

        /* Main Content Area */
        .dashboard-main-content {
            flex-grow: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px; /* Spasi antar grid dan notifikasi */
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Responsif */
            gap: 20px;
        }

        /* Styling untuk link kartu agar seluruh kartu bisa diklik */
        .info-card-link {
            text-decoration: none; /* Menghilangkan underline default link */
            color: inherit; /* Mewarisi warna teks dari parent */
            display: block; /* Membuat link menjadi blok untuk membungkus card */
        }

        /* Styling untuk kartu secara umum (info-card yang dibungkus oleh info-card-link) */
        .info-card {
            background-color: var(--card-bg-green); /* Warna hijau background card seperti di gambar */
            color: var(--text-white); /* Warna teks putih */
            border-radius: var(--border-radius-lg); /* Sudut melengkung */
            box-shadow: 0 4px 8px var(--shadow-color); /* Bayangan default */
            padding: 20px; /* Padding di dalam kartu */
            position: relative; /* Penting untuk penempatan ikon panah absolut */
            overflow: hidden; /* Penting jika ada konten yang keluar batas radius */
            display: flex; /* Menggunakan flexbox untuk layout internal */
            flex-direction: column; /* Konten diatur secara kolom */
            justify-content: space-between; /* Untuk memisahkan header dan deskripsi */
            min-height: 120px; /* Tinggi minimum kartu agar konsisten */
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out; /* Transisi untuk hover */
        }

        /* Efek hover pada seluruh kartu */
        .info-card-link:hover .info-card {
            transform: translateY(-3px); /* Sedikit naik saat di-hover */
            box-shadow: 0 8px 16px var(--shadow-color-hover); /* Bayangan lebih besar saat di-hover */
        }

        /* Header di dalam kartu (ikon + judul) */
        .info-card .card-header {
            display: flex; /* Menggunakan flexbox untuk ikon dan judul */
            align-items: center; /* Sejajarkan secara vertikal */
            margin-bottom: 10px; /* Jarak antara header dan deskripsi */
        }

        /* Styling ikon gambar (misalnya ikon download di gambar) */
        .card-image-icon {
            width: 60px; /* Ukuran ikon gambar, sesuaikan jika perlu */
            height: 60px;
            margin-right: 15px;
            flex-shrink: 0; /* Mencegah ikon menyusut di layar kecil */
        }
        /* Ikon Font Awesome di kartu utama - saya asumsikan ini tidak dipakai jika ada gambar PNG */
        /* Jika Anda ingin menggunakan Font Awesome, hapus `<img class="card-image-icon">` dari HTML */
        /* .info-card .card-icon {
            font-size: 48px;
            margin-right: 15px;
            color: var(--text-white);
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
        } */


        /* Styling judul kartu (misalnya "Barang Masuk") */
        .info-card .card-title {
            font-size: 22px; /* Ukuran font lebih besar */
            font-weight: bold; /* Teks tebal */
            margin: 0;
            line-height: 1.2; /* Mengatur tinggi baris */
            flex-grow: 1; /* Memungkinkan judul mengisi ruang tersisa */
        }

        /* Styling deskripsi kartu */
        .info-card .card-description {
            font-size: 14px; /* Ukuran font lebih kecil */
            margin-top: 5px;
            line-height: 1.5;
            opacity: 0.9; /* Sedikit transparan agar berbeda dari judul */
        }

        /* Styling ikon panah di pojok kanan atas */
        .arrow-icon {
            position: absolute; /* Posisi absolut terhadap .info-card */
            top: 20px; /* Jarak dari atas */
            right: 20px; /* Jarak dari kanan */
            font-size: 20px; /* Ukuran ikon panah */
            color: var(--text-white); /* Warna ikon panah putih */
            cursor: pointer; /* Mengubah kursor menjadi pointer saat di-hover */
            transition: transform 0.2s ease-in-out; /* Efek transisi saat hover */
            z-index: 5; /* Pastikan di atas konten lain jika ada tumpang tindih */
        }

        /* Efek hover pada ikon panah saat seluruh kartu di-hover */
        .info-card-link:hover .arrow-icon {
            transform: translateX(5px); /* Geser sedikit ke kanan saat di-hover */
        }


        /* Notifikasi Card */
        .notifications-card {
            background-color: var(--text-white);
            color: #333;
            border-radius: var(--border-radius-lg);
            box-shadow: 0 4px 8px var(--shadow-color);
            padding: 20px;
            position: relative; /* Penting untuk panah notifikasi */
        }

        .notifications-card .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px; /* Jarak yang cukup */
        }
        /* Styling untuk ikon gambar di Notifications Card header */
        .notifications-card .card-image-icon {
            width: 25px; /* Ukuran lebih kecil untuk ikon notifikasi */
            height: 25px;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .notifications-card .card-title {
            font-size: 20px;
            font-weight: bold;
            flex-grow: 1;
        }
        /* Ikon panah di notifikasi card */
        .notifications-card .arrow-icon {
            position: static; /* Mengatur ulang posisi */
            margin-left: auto; /* Mendorong ke kanan */
            color: #555; /* Warna panah di card notifikasi (abu-abu gelap) */
            cursor: pointer;
            font-size: 20px;
        }
        /* Efek hover untuk panah di notifikasi */
        .notifications-card .arrow-icon:hover {
            transform: translateX(3px); /* Sedikit bergeser ke kanan */
        }


        .notification-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .notification-list li {
            display: flex;
            align-items: flex-start; /* Sejajarkan ikon dan teks di awal */
            margin-bottom: 12px;
            font-size: 15px;
        }

        .notification-list li:last-child {
            margin-bottom: 0;
        }

        .notification-icon {
            font-size: 20px;
            margin-right: 10px;
            width: 25px; /* Untuk konsistensi posisi */
            text-align: center;
            flex-shrink: 0; /* Mencegah ikon menyusut */
            margin-top: 2px; /* Penyesuaian vertikal */
        }

        .notification-icon.red { color: #f44336; } /* Merah untuk hujan */
        .notification-icon.blue { color: #2196f3; } /* Biru untuk pesan */
        .notification-icon.orange { color: #ff9800; } /* Oranye untuk makanan */

        .notification-text {
            flex-grow: 1;
            line-height: 1.4;
        }

        .notification-time {
            font-size: 13px;
            color: #888;
            margin-left: 10px;
            white-space: nowrap; /* Mencegah waktu pecah baris */
            flex-shrink: 0; /* Mencegah waktu menyusut */ q
        }


        /* Responsivitas dasar */
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
                padding-bottom: 10px; /* Sedikit padding di bawah menu sidebar */
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
                grid-template-columns: 1fr; /* Satu kolom untuk layar sangat kecil */
            }
            .info-card .card-title, .notifications-card .card-title {
                font-size: 18px;
            }
            .card-image-icon { /* Pastikan ini ada di media query jika Anda ingin responsif */
                width: 50px;
                height: 50px;
            }
            /* Jika .info-card .card-icon (Font Awesome) masih digunakan */
            /* .info-card .card-icon {
                font-size: 36px;
            } */
        }
    </style>
</head>
<body>
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
                            <a href="#">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                Barang Masuk
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                Barang Keluar
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                Update Barang
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
                <div class="cards-grid">
                    {{-- KARTU BARANG MASUK --}}
                    <a href="{{ url('/barang-masuk') }}" class="info-card-link">
                        <div class="info-card">
                            <div class="card-header">
                                {{-- Menggunakan ICON GAMBAR "masuk.png" --}}
                                <img src="{{ asset('images/masuk.png') }}" alt="Barang Masuk Icon" class="card-image-icon">
                                {{-- <i class="fas fa-download card-icon"></i> <-- Hapus ini jika menggunakan gambar PNG --}}
                                <span class="card-title">Barang Masuk</span>
                            </div>
                            <p class="card-description">Cek & input barang baru masuk.</p>
                            <i class="fas fa-chevron-right arrow-icon"></i>
                        </div>
                    </a>

                    {{-- KARTU BARANG KELUAR --}}
                    <a href="{{ url('/barang-keluar') }}" class="info-card-link">
                        <div class="info-card">
                            <div class="card-header">
                                <img src="{{ asset('images/keluar.png') }}" alt="Barang Keluar Icon" class="card-image-icon">
                                {{-- <i class="fas fa-upload card-icon"></i> --}}
                                <span class="card-title">Barang Keluar</span>
                            </div>
                            <p class="card-description">Catat dan proses barang yang dikeluarkan dari gudang.</p>
                            <i class="fas fa-chevron-right arrow-icon"></i>
                        </div>
                    </a>

                    {{-- KARTU PENGEMBALIAN --}}
                    <a href="{{ url('/pengembalian') }}" class="info-card-link">
                        <div class="info-card">
                            <div class="card-header">
                                <img src="{{ asset('images/kembali.png') }}" alt="Pengembalian Icon" class="card-image-icon">
                                {{-- <i class="fas fa-exchange-alt card-icon"></i> --}}
                                <span class="card-title">Pengembalian</span>
                            </div>
                            <p class="card-description">Verifikasi dan proses barang yang dikembalikan user.</p>
                            <i class="fas fa-chevron-right arrow-icon"></i>
                        </div>
                    </a>

                    {{-- KARTU UPDATE STATUS BARANG --}}
                    <a href="{{ url('/update-status-barang') }}" class="info-card-link">
                        <div class="info-card">
                            <div class="card-header">
                                <img src="{{ asset('images/note.png') }}" alt="Update Status Icon" class="card-image-icon">
                                {{-- <i class="fas fa-sync-alt card-icon"></i> --}}
                                <span class="card-title">Update Status Barang</span>
                            </div>
                            <p class="card-description">Ubah kondisi, lokasi, atau status terbaru barang.</p>
                            <i class="fas fa-chevron-right arrow-icon"></i>
                        </div>
                    </a>

                    {{-- KARTU DATA BARANG --}}
                    <a href="{{ url('/data-barang') }}" class="info-card-link">
                        <div class="info-card">
                            <div class="card-header">
                                <img src="{{ asset('images/box.png') }}" alt="Data Barang Icon" class="card-image-icon">
                                {{-- <i class="fas fa-database card-icon"></i> --}}
                                <span class="card-title">Data Barang</span>
                            </div>
                            <p class="card-description">Lihat daftar lengkap barang yang tersedia di gudang.</p>
                            <i class="fas fa-chevron-right arrow-icon"></i>
                        </div>
                    </a>
                </div>

                <div class="notifications-card">
                    <div class="card-header">
                        <img src="{{ asset('images/bell.png') }}" alt="Notifications Icon" class="card-image-icon">
                        <span class="card-title">Notifications</span>
                        {{-- Panah notifikasi juga bisa diklik --}}
                        <a href="{{ url('/notifications') }}" style="text-decoration: none;">
                             <i class="fas fa-chevron-right arrow-icon"></i>
                        </a>
                    </div>
                    <ul class="notification-list">
                        <li>
                            <i class="fas fa-cloud-rain notification-icon red"></i>
                            <span class="notification-text">Possible raining in 14:30</span>
                            <span class="notification-time">5 min ago</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope notification-icon blue"></i>
                            <span class="notification-text">New message from Boss</span>
                            <span class="notification-time">12 min ago</span>
                        </li>
                        <li>
                            <i class="fas fa-utensils notification-icon orange"></i>
                            <span class="notification-text">Your food will arrive in 20 minutes</span>
                            <span class="notification-time">16 min ago</span>
                        </li>
                    </ul>
                </div>
            </main>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/YOUR_UNIQUE_KIT_CODE.js" crossorigin="anonymous"></script>
</body>
</html>