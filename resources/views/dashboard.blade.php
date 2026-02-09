<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Inventaris Hardware</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<nav style="background:#a78bfa;padding:15px;color:white;">
    <strong>Inventaris Hardware</strong>
    <span style="float:right;">
        {{ auth()->user()->name }} |
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" style="background:none;border:none;color:white;cursor:pointer;">Logout</button>
        </form>
    </span>
</nav>

<div style="display:flex;">
    <aside style="width:200px;background:#ede9fe;min-height:100vh;padding:20px;">
        <ul style="list-style:none;padding:0;">

            {{-- Menu Admin --}}
            @if(auth()->user()->role == 'admin')
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('inventaris.index') }}">Data Inventaris</a></li>
                <li><a href="{{ route('inventaris.exportPdf') }}">Export PDF</a></li>
            @endif

            {{-- Menu User --}}
            @if(auth()->user()->role == 'user')
                <li><a href="{{ route('user.inventaris') }}">Inventaris</a></li>
                <li><a href="{{ route('inventaris.exportPdf') }}">Export PDF</a></li>
            @endif

        </ul>
    </aside>

    <main style="flex:1;padding:30px;">
        @yield('content')
    </main>
</div>
</body>
</html>
