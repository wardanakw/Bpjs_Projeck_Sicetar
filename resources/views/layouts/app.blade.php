<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SICETAR') }} - @yield('title')</title>
    <link rel="icon" href="{{ asset('img/Bpjslogo.jpg') }}" type="image/jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
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
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: width 0.3s;
        }
        .sidebar.collapsed {
            width: 70px;
        }
        .sidebar h2 {
        text-align: center;
        padding: 20px 0;
        font-size: 20px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        white-space: nowrap;
        overflow: hidden;
        font-weight: 700; 
        font-family: 'Poppins', 'Segoe UI', 'Arial', sans-serif; 
        }

        .sidebar.collapsed h2 {
            font-size: 16px;
            padding: 20px 5px;
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
            transition: all 0.3s;
        }
        .sidebar.collapsed ul li a {
            padding: 12px 15px;
            justify-content: center;
        }
        .sidebar.collapsed ul li a span {
            display: none;
        }
        .sidebar ul li a:hover {
            background: #2e4a7d;
        }
        .topbar {
            position: fixed;
            left: 220px;
            right: 0;
            top: 0;
            height: 60px;
            background: #2e4a7d;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            transition: left 0.3s;
            z-index: 999;
        }
        .sidebar.collapsed ~ .topbar {
            left: 70px;
        }
        .topbar .menu-btn {
            font-size: 22px;
            color: white;
            cursor: pointer;
        }
        .topbar .right {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .topbar .logout {
            background: #e74c3c;
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .topbar .profile {
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            font-weight: 500;
        }
        .topbar .profile-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        .content {
            flex: 1;
            margin-left: 220px;
            margin-top: 60px;
            padding: 20px;
            background: #f4f4f4;
            min-height: calc(100vh - 60px);
            transition: margin-left 0.3s;
            min-width: 0;
        }
        .sidebar.collapsed ~ .content {
            margin-left: 70px;
        }
        .table-responsive {
            overflow-x: auto;
            width: 100%;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            padding: 8px 0;
            -webkit-overflow-scrolling: touch;
            
            
        }
        .table-responsive table {
            min-width: 800px;
        }
        table th, table td {
            vertical-align: middle;
            padding: 6px 8px;
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
            position: sticky;
            top: 0;
            letter-spacing: 0.5px;
            z-index: 2;
        }
        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            margin: 0;
            background: white;
            table-layout: auto;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 20px;
            font-weight: 600;
        }
        .card-body {
            padding: 20px;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .fkrtl-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .fkrtl-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .fkrtl-card h5 {
            color: #2e4a7d;
            margin-bottom: 10px;
        }
        .fkrtl-card p {
            color: #666;
            margin-bottom: 5px;
        }
        .fkrtl-card .badge {
            background: #2e4a7d;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #ced4da;
        }
        .form-control:focus, .form-select:focus {
            border-color: #2e4a7d;
            box-shadow: 0 0 0 0.2rem rgba(46, 74, 125, 0.25);
        }
        .input-group-text {
            background: #f8f9fa;
            border: 1px solid #ced4da;
        }
        .btn-primary {
            background: #2e4a7d;
            border-color: #2e4a7d;
        }
        .btn-primary:hover {
            background: #1e3a6d;
            border-color: #1e3a6d;
        }

      
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            .sidebar h2 {
                font-size: 16px;
                padding: 20px 5px;
            }
            .sidebar ul li a span {
                display: none;
            }
            .topbar {
                left: 70px;
            }
            .content {
                margin-left: 70px;
            }
            .topbar .profile-text {
                display: none;
            }
        }

         tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tbody tr:hover {
            background-color: #e9ecef;
        }
        
      
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }
        
        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        .table-responsive::-webkit-scrollbar-thumb {
            background: #a0a0a0;
            border-radius: 4px;
        }
        
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #808080;
        }
        
        .table-responsive table {
            min-width: 110%; 
            width: 100%;
            margin-bottom: 0;
            border-collapse: collapse; 
        }
        
        table th, table td {
            vertical-align: middle;
            padding: 12px 15px; 
            border: 1px solid #dee2e6;
            text-align: center;
            font-size: 14px;
            background: #fff;
            min-width: 120px;
            word-break: break-word;
            white-space: nowrap; 
        }
        
        table th {
            background: #e9ecef;
            font-weight: 600;
            position: sticky;
            top: 0;
            letter-spacing: 0.5px;
            z-index: 10; 
        }
       
        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tbody tr:hover {
            background-color: #e9ecef;
        }
        .form-split{
            display: flex;
            gap: 32px;
            flex-wrap: wrap;
        }
        .form-split .form-col{
            flex: 1 1 0;
            min-width: 280px;
        }
    .no-input {
        max-width: 70px;
    }
    .date-input {
        max-width: 150px; 
    }
        
    </style>
</head>
<body>
  <body>
    <div class="layout">
        <div class="sidebar">
            <h2>{{ config('app.name', 'SICETAR') }} </h2>
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

            
@if(auth()->user()->role === 'admin')
    <li>
        <a href="{{ route('fkrtl.index') }}">
            <i class="fas fa-hospital"></i>
            <span>Menu FKRTL</span>
        </a>
    </li>
    <li>
        <a href="{{ route('pelayanan.index') }}">
            <i class="fas fa-chart-line"></i>
            <span>Monitoring SLA</span>
        </a>
    </li>
    <li>
        <a href="{{ route('koreksi.index') }}">
            <i class="fas fa-edit"></i>
            <span>Koreksi SLA</span>
        </a>
    </li>
    <li>
        <a href="{{ route('export.index') }}">
            <i class="fas fa-file-export"></i>
            <span>Export SLA</span>
        </a>
    </li>
@endif


@if(auth()->user()->role === 'finance')
    <li>
        <a href="{{ route('pelayanan.index') }}">
            <i class="fas fa-chart-line"></i>
            <span>Monitoring SLA</span>
        </a>
    </li>
    <li>
        <a href="{{ route('koreksi.index') }}">
            <i class="fas fa-edit"></i>
            <span>Koreksi SLA</span>
        </a>
    </li>
    <li>
        <a href="{{ route('export.index') }}">
            <i class="fas fa-file-export"></i>
            <span>Export SLA</span>
        </a>
    </li>
    <li>
        <a href="{{ route('rekap.index') }}">
            <i class="fas fa-book"></i>
            <span>Rekap Register Klaim</span>
        </a>
    </li>
@endif


@if(auth()->user()->role === 'keuangan')
    <li>
        <a href="{{ route('pelayanan.index') }}">
            <i class="fas fa-chart-line"></i>
            <span>Monitoring SLA</span>
        </a>
    </li>
    <li>
        <a href="{{ route('koreksi.index') }}">
            <i class="fas fa-edit"></i>
            <span>Koreksi SLA</span>
        </a>
    </li>
    <li>
        <a href="{{ route('rekap.index') }}">
            <i class="fas fa-book"></i>
            <span>Rekap Register Klaim</span>
        </a>
    </li>
@endif

@if(auth()->user()->role === 'verifikator')
    <li>
        <a href="{{ route('pelayanan.index') }}">
            <i class="fas fa-chart-line"></i>
            <span>Monitoring SLA</span>
        </a>
    </li>
      <li>
        <a href="{{ route('export.index') }}">
            <i class="fas fa-file-export"></i>
            <span>Export SLA</span>
        </a>
    </li>
@endif

@if(auth()->user()->role === 'PMU')
    <li>
        <a href="{{ route('pelayanan.index') }}">
            <i class="fas fa-chart-line"></i>
            <span>Monitoring SLA</span>
        </a>
    </li>
    <li>
        <a href="{{ route('koreksi.index') }}">
            <i class="fas fa-edit"></i>
            <span>Koreksi SLA</span>
        </a>
    </li>
    <li>
        <a href="{{ route('export.index') }}">
            <i class="fas fa-file-export"></i>
            <span>Export SLA</span>
        </a>
    </li>
    <li>
        <a href="{{ route('rekap.index') }}">
            <i class="fas fa-book"></i>
            <span>Rekap Register Klaim</span>
        </a>
    </li>
@endif

        </div>

        <div class="topbar">
            <div class="menu-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </div>
            <div class="right">
                <div class="profile">
                    <div class="profile-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="profile-text">
    {{ auth()->user()->name }}
</span>

                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="content">
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNotifikasiUpload" tabindex="-1" aria-labelledby="modalNotifikasiUploadLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNotifikasiUploadLabel">Notifikasi Upload</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{-- Konten notifikasi upload --}}
        <div class="alert alert-success" role="alert">
          <i class="fas fa-check-circle"></i> File berhasil diunggah!
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('collapsed');
        }

     
        function checkScreenSize() {
            if (window.innerWidth <= 768) {
                document.querySelector('.sidebar').classList.add('collapsed');
            } else {
                document.querySelector('.sidebar').classList.remove('collapsed');
            }
        }

   
        window.addEventListener('load', checkScreenSize);
        window.addEventListener('resize', checkScreenSize);
    </script>
    @stack('scripts')
</body>
</html>
