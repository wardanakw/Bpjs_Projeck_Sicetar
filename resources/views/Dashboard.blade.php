<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SICETAR</title>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family: Arial, sans-serif; }

     
        .sidebar { position: fixed; left:0; top:0; width:220px; height:100%; background:#1e2a31; color:white; padding:20px 0; transition:width 0.3s; overflow:hidden; }
        .sidebar.collapsed { width:70px; }
        .sidebar h2 { text-align:center; margin-bottom:30px; font-size:20px; transition;opacity 0.3s; }
        .sidebar.collapsed h2 { opacity:0; }
        .sidebar ul { list-style:none; }
        .sidebar ul li { padding:15px 20px; }
        .sidebar ul li a { color:white; text-decoration:none; display:flex; align-items:center; gap:10px; white-space:nowrap; }
        .sidebar ul li a i { min-width:20px; text-align:center; }

        .topbar { position: fixed; left:220px; right:0; top:0; height:60px; background:#2e4a7d; display:flex; justify-content:space-between; align-items:center; padding:0 20px; transition:left 0.3s; }
        .sidebar.collapsed ~ .topbar { left:70px; }
        .topbar .menu-btn { font-size:22px; color:white; cursor:pointer; }
        .topbar .right { display:flex; align-items:center; gap:15px; }
        .topbar .logout { background:#e74c3c; border:none; color:white; padding:8px 12px; border-radius:5px; cursor:pointer; }
        .topbar .profile { width:35px; height:35px; border-radius:50%; background:#ccc; }

        .content { margin-left:240px; margin-top:80px; padding:20px; transition; margin-left 0.3s; }
        .sidebar.collapsed ~ .content { margin-left:90px; }
        .content h3 { font-size:20px; }
        .subtitle { font-size:14px; color:gray; }

     
        .cards { display:flex; gap:20px; margin-top:20px; flex-wrap:wrap; }
        .card { flex:1; min-width:200px; display:flex; align-items:center; gap:15px; padding:20px; border-radius:10px; color:white; }
        .card .icon { font-size:30px; }
        .blue { background:#3498db; }
        .green { background:#2ecc71; }
        .orange { background:#f39c12; }
        .card p { font-size:14px; }
        .card h2 { font-size:22px; font-weight:bold; }
    </style>
</head>
<body>
  
    <div class="sidebar" id="sidebar">
        <h2><a href="{{ route('dashboard') }}" style="color:white; text-decoration:none;">SICETAR</a></h2>
        <ul>
            <li>
                <a href="{{ route('fkrtl.index') }}">
                    <i class="fas fa-hospital"></i>
                    <span class="label">Nama FKRTL</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pelayanan.index') }}">
                    <i class="fas fa-chart-line"></i>
                    <span class="label">Monitoring SLA</span>
                </a>
            </li>
            <li>
                <a href="#"><i class="fas fa-edit"></i><span class="label">Koreksi SLA</span></a>
            </li>
            <li>
                <a href="#"><i class="fas fa-file-export"></i><span class="label">Export SLA</span></a>
            </li>
        </ul>
    </div>

   
    <div class="topbar" id="topbar">
        <div class="menu-btn" onclick="toggleSidebar()">☰</div>
        <div class="right">
            <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="logout">Logout</button>
</form>

            <div class="profile"></div>
        </div>
    </div>

    
    <div class="content" id="content">
        <h3>SICETAR <span class="subtitle">Control Panel</span></h3>

        <div class="cards">
            <div class="card blue">
                <div class="icon"><i class="fas fa-hospital"></i></div>
                <div>
                    <p>Jumlah RS</p>
                    <h2>{{ $jumlah_rs }}</h2>
                </div>
            </div>

            <div class="card green">
                <div class="icon"><i class="fas fa-clock"></i></div>
                <div>
                    <p>Jumlah Pengajuan</p>
                    <h2>{{ $jumlah_pengajuan }}</h2>
                </div>
            </div>

            <div class="card orange">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div>
                    <p>Jumlah Admin</p>
                    <h2>{{ $jumlah_admin }}</h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("topbar").classList.toggle("collapsed");
            document.getElementById("content").classList.toggle("collapsed");
        }
    </script>
</body>
</html>
