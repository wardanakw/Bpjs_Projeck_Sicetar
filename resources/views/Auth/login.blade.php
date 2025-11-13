<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login SICETAR</title>
  <link rel="icon" href="{{ asset('img/Bpjslogo.jpg') }}" type="image/jpg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
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
   
    .captcha-container {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .captcha-input-container {
      flex: 1;
    }
    .btn-refresh-captcha {
      background-color: #2A4D8B;
      color: white;
      border: none;
      height: 38px; 
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 0.375rem;
      transition: background-color 0.15s ease-in-out;
    }
    .btn-refresh-captcha:hover {
      background-color: #1e3a6b;
    }
    h4 {
      text-align: center;
      padding: 20px 0;
      font-size: 30px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
      white-space: nowrap;
      overflow: hidden;
      font-weight: 700;
      font-family: 'Poppins', 'Segoe UI', 'Arial', sans-serif; 
    }
    
    /* CSS tambahan untuk toggle password */
    .password-container {
      position: relative;
    }
    .toggle-password {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: #6c757d;
    }
    .toggle-password:hover {
      color: #2A4D8B;
    }
  </style>
</head>
<body>
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-md-9 left-side">
        <div class="login-box">
          <h4 class="mb-4 text-center">Login Masuk CETAR</h4>

          <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">User name</label>
              <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" required>     
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Enter your Password</label>
              <div class="password-container">
                <input type="password" class="form-control" name="password" id="password" required>
                <button type="button" class="toggle-password" id="togglePassword">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                  </svg>
                </button>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Captcha</label><br>
              <img src="{{ captcha_src() }}" class="captcha-img mb-2" alt="captcha"
                   onclick="this.src='{{ captcha_src() }}?'+Math.random()">
              
              <div class="captcha-container">
                <div class="captcha-input-container">
                  <input type="text" class="form-control" name="captcha" placeholder="Masukkan captcha" required>
                </div>
                <button type="button" class="btn-refresh-captcha" id="refresh-captcha-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                  </svg>
                </button>
              </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
        </div>
        
        <img src="img/Bpjs.jpg" alt="Logo" class="logo-img">
      </div>
    
      <div class="col-md-3 right-side d-none d-md-block"></div>
    </div>
  </div>

  {{-- Modal untuk notifikasi error --}}
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var notifModal = document.getElementById('notifModal');
      if (notifModal) {
        var modal = new bootstrap.Modal(notifModal);
        modal.show();
      }

      function refreshCaptcha() {
        const captchaImg = document.querySelector('.captcha-img');
        captchaImg.src = '{{ captcha_src() }}?' + Math.random();
      }

      document.getElementById('refresh-captcha-btn').addEventListener('click', refreshCaptcha);
      
      // Fungsi untuk toggle password
      const togglePassword = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('password');
      
      togglePassword.addEventListener('click', function() {
        // Toggle tipe input password/text
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Toggle ikon password
        if (type === 'text') {
          this.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
              <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
              <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
              <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
            </svg>
          `;
        } else {
          this.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
            </svg>
          `;
        }
      });
    });
  </script>
</body>
</html>
