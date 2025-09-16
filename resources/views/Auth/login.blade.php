<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login SICETAR</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
    }
    .login-box {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      padding: 40px;
      width: 100%;
      max-width: 400px;
      z-index: 2;
    }
    .captcha-img {
      cursor: pointer;
    }
    .left-side {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff;
    height: 100vh;
  }
    .right-side {
    background-color: #2A4D8B;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }
    .logo-img {
      position: absolute;
      width: 400px;
      height: 400px;
      top: 50%;
      left: calc(50% + 200px); 
      transform: translateY(-50%);
      aspect-ratio: 1/1;
      object-fit: cover;
      border-radius: 10px;
      z-index: 1;
    }
  </style>
</head>
<body>
  <div class="container-fluid h-100">
    <div class="row h-100">

    
      <div class="col-md-9 left-side">
        
   
        <div class="login-box">
          <h4 class="mb-4 text-center">Login SICETAR</h4>

          
              <!-- {{-- Notifikasi Error --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Terjadi Kesalahan!</strong>
        <ul class="mb-0 mt-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif -->

          <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">User name</label>
              <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" required>     
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Enter your Password</label>
              <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Captcha</label><br>
              <img src="{{ captcha_src() }}" class="captcha-img mb-2" alt="captcha"
                   onclick="this.src='{{ captcha_src() }}?'+Math.random()">
              <input type="text" class="form-control" name="captcha" placeholder="Masukkan captcha" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
        </div>

        
        <img src="img/Bpjs.jpg" alt="Logo" class="logo-img">

      </div>

    
      <div class="col-md-3 right-side d-none d-md-block"></div>
    </div>
  </div>

  {{-- Tambahkan modal popup di bawah login-box --}}
@if ($errors->any() || session('error'))
  <div class="modal fade" id="notifModal" tabindex="-1" aria-labelledby="notifModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="notifModalLabel">Notifikasi Error</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @if ($errors->any())
            <ul class="mb-0 mt-1">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif
          @if (session('error'))
            <div>{{ session('error') }}</div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endif

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var notifModal = document.getElementById('notifModal');
    if (notifModal) {
      var modal = new bootstrap.Modal(notifModal);
      modal.show();
    }
  });
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
