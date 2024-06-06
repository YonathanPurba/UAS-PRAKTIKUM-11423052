<!-- Navbar code -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
    <a class="navbar-brand text-brand" href="/">Badminton</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarDefault">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Login
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('user.login') }}">Login User</a></li>
            <li><a class="dropdown-item" href="/admin/login">Login Admin</a></li>
            <li><a class="dropdown-item" href="/pengelola/login">Login Pengelola</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.register') }}">Register</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
