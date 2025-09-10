<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SICETAR') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            background: #f4f4f4;
            overflow-x: hidden;
        }
        .layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 220px;
            background: #1e2a31 !important;
            color: white !important;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 100;
        }
        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            font-size: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
        }
        .sidebar ul li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            gap: 10px;
            white-space: nowrap;
        }
        .sidebar ul li a:hover {
            background: #2e4a7d;
        }
        .topbar { position: fixed;
             left:220px; right:0;
              top:0; height:60px;
               background:#2e4a7d; 
               display:flex; 
               justify-content:space-between; 
               align-items:center; 
               padding:0 20px; 
               transition:left 0.3s; }
        .sidebar.collapsed ~ .topbar {
             left:70px;
             }
        .topbar .menu-btn { 
            font-size:22px; 
            color:white; 
            cursor:pointer;
         }
        .topbar .right { 
            display:flex; 
            align-items:center; 
            gap:15px; }
        .topbar .logout { 
            background:#e74c3c;
             border:none; color:white; 
             padding:8px 12px; 
             border-radius:5px; 
             cursor:pointer; }
        .topbar .profile { 
            width:35px;
             height:35px;
              border-radius:50%;
               background:#ccc; }
        .content {
            flex: 1;
            min-width: 0;
            margin-left: 0;
            margin-top: 0;
            padding: 20px;
            background: #f4f4f4;
        }
        .table-responsive {
            overflow-x: auto;
            width: 100%;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            padding: 8px 0;
        }
        .table-responsive table {
            min-width: 1200px;
        }
        table th, table td {
            vertical-align: middle !important;
            padding: 12px 24px;
            border: 1px solid #dee2e6;
            text-align: center;
            font-size: 15px;
            background: #fff;
            min-width: 120px;
            word-break: break-word;
        }
        table th {
            background: #e9ecef;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        table {
            border-collapse: separate;
            border-spacing: 0 8px;
            background: white;
            width: 100%;
            table-layout: auto;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        .list-group-item {
    border: 1px solid #dee2e6;
    margin-bottom: 2px;
    border-radius: 4px;
}

.sub-item {
    padding-left: 2rem;
    background-color: #f8f9fa;
}

.form-check-input {
    margin-right: 10px;
}

.list-group-item[data-bs-toggle="collapse"] {
    background-color: #0d6efd;
    color: white;
    font-weight: bold;
}

.list-group-item[data-bs-toggle="collapse"]:hover {
    background-color: #0b5ed7;
}

.collapse.show {
    border: 1px solid #dee2e6;
    border-top: none;
    border-radius: 0 0 4px 4px;
}

.form-select, .form-control {
    border-radius: 0.375rem;
}

.input-group-text {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
}

    </style>
</head>
<body>
    <div class="layout">
        <div class="sidebar">
            <h2>{{ config('app.name', 'SICETAR') }}</h2>
            <ul>
                <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
                <li><a href="{{ route('pelayanan.index') }}"><i class="fas fa-chart-line"></i>Monitoring SLA</a></li>
                <li><a href="#"><i class="fas fa-edit"></i>Koreksi SLA</a></li>
                <li><a href="#"><i class="fas fa-file-export"></i>Export SLA</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="topbar">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>