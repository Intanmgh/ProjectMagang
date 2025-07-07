<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Halaman Pimpinan')</title>
    @vite(['resources/js/app.js'])
    <style>
        :root {
            --green-dark: #1b5e20;
            --green:       #2e7d32;
            --green-lite:  #43a047;
        }
        body       { margin:0; font-family: 'Segoe UI', Arial, sans-serif; }
        .topbar    { height:55px; background:var(--green); color:#fff; display:flex; align-items:center; padding:0 24px; }
        .topbar img{ height:38px; margin-right:16px; }
        .sidebar   { width:240px; background:var(--green-dark); color:#fff; position:fixed; top:55px; bottom:0; }
        .sidebar a { display:block; padding:14px 22px; color:inherit; text-decoration:none; }
        .sidebar a.active, .sidebar a:hover { background:var(--green-lite); }
        main       { margin-left:240px; margin-top:55px; padding:24px; background:#f0f2f5; min-height:calc(100vh - 55px); }
        .card      { background:#fff; border-radius:8px; box-shadow:0 2px 4px rgba(0,0,0,.08); padding:24px; }
        table      { width:100%; border-collapse:collapse; }
        th,td      { padding:10px 8px; border-bottom:1px solid #e0e0e0; }
    </style>
</head>
<body>
    {{-- Top Bar --}}
    <header class="topbar">
        <img src="{{ asset('tel_logo.png') }}" alt="TeL Logo">
        <h1 style="font-size:18px; font-weight:600;">PT TANJUNGENIM LESTARI PULP AND PAPER</h1>
    </header>

    {{-- Sidebar --}}
    <nav class="sidebar">
        <a href="{{ route('pimpinan.kelola') }}" class="{{ request()->routeIs('pimpinan.kelola') ? 'active' : '' }}">
            Kelola&nbsp;Barang
        </a>
        
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>
</body>
</html>
