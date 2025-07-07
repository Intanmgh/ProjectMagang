<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('navbar-title', 'Dashboard User')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
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
            position: relative;
            margin-right: 30px;
        }

        .user-role {
            background-color: white;
            color: #388E3C;
            padding: 8px 16px;
            border: none;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 120%;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            padding: 8px 0;
            border-radius: 5px;
            min-width: 150px;
            z-index: 999;
        }

        .logout-dropdown a {
            color: #d9534f;
            text-decoration: none;
            display: block;
            padding: 10px 16px;
            font-weight: bold;
        }

        .logout-dropdown a:hover {
            background-color: #f8d7da;
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
        <div class="user-role-container">
            <button class="user-role" onclick="toggleLogout()">User ⮟</button>
            <div id="logoutDropdown" class="logout-dropdown">
                <a href="{{ route('user.logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <ul>
            <li><a href="{{ url('/user/databarang') }}">Data Barang</a></li>
            <li><a href="{{ url('/user/pengajuan') }}">Pengajuan</a></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Script Dropdown -->
    <script>
        function toggleLogout() {
            const dropdown = document.getElementById('logoutDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        window.addEventListener('click', function (e) {
            if (!e.target.closest('.user-role-container')) {
                document.getElementById('logoutDropdown').style.display = 'none';
            }
        });
    </script>

</body>
</html>