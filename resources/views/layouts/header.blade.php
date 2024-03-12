<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Company</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ url('/crud') }}">CRUD</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">Hitung</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li> --}}
        </ul>
      </div>
    </div>
  </nav>