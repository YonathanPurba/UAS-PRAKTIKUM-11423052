<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Register - Sewa Lapangan Buserton</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Register</h3>

            <form action="{{ url('/user/register') }}" method="POST">
              @csrf
              <div class="form-outline mb-4">
                <input type="text" id="username" name="username" class="form-control form-control-lg" required />
                <label class="form-label" for="username">Username</label>
              </div>
              @error('username')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror

              <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                <label class="form-label" for="email">Email</label>
              </div>
              @error('email')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror

              <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                <label class="form-label" for="password">Password</label>
              </div>
              @error('password')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror

              <div class="form-outline mb-4">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" required />
                <label class="form-label" for="password_confirmation">Confirm Password</label>
              </div>

              <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
            </form>

            <hr class="my-4">
            
            <a href="/">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
