<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('navbar-title', 'Dashboard Pimpinan')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
        }

        .topbar {
            background-color: #388E3C;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            justify-content: space-between;
        }

        .topbar .left {
            display: flex;
            align-items: center;
        }

        .topbar img {
            height: 40px;
            margin-right: 15px;
        }

        .topbar h1 {
            font-size: 20px;
            margin: 0;
            font-weight: normal;
        }

        .user-role-container {
            padding-right: 20px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .user-role {
            background-color: white;
            color: #388E3C;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 140px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            border-radius: 5px;
            z-index: 1001;
        }

        .dropdown-content a {
            color: #388E3C;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
            font-weight: bold;
        }

        .dropdown-content a:hover {
            background-color: #f0f0f0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .sidebar {
            position: fixed;
            top: 70px;
            left: 0;
            width: 220px;
            height: calc(100vh - 70px);
            background-color: #2E7D32;
            padding-top: 20px;
            color: white;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
        }

        .sidebar ul li a:hover {
            background-color: #1B5E20;
        }

        .logout-button {
            display: block;
            margin: 20px;
            padding: 10px;
            background-color: white;
            color: #d9534f;
            border: 1px solid #d9534f;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .logout-button:hover {
            background-color: #d9534f;
            color: white;
        }

        .content {
            margin-left: 220px;
            padding: 85px 30px 30px 30px;
        }
    </style>
</head>
<body>

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="left">
            <img src="{{ asset('image/logo tel.png') }}" alt="TEL Logo">
            <h1>PT TANJUNGENIM LESTARI PULP AND PAPER</h1>
        </div>
        <div class="dropdown" style="margin-right: 30px;">
    <button class="dropdown-toggle">Pimpinan ⮟</button>
    <div class="dropdown-content">
        <a href="{{ url('/logout') }}">Logout</a>
    </div>
</div>

    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <ul>
             <li><a href="{{ url('/pimpinan/barang-masuk') }}">Kelola Barang</a></li>
            <li><a href="{{ url('/pimpinan/databarang') }}">Data Barang</a></li>
           
            <li><a href="{{ url('/pimpinan/barang-keluar') }}">Riwayat Peminjaman</a></li>
            
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>
