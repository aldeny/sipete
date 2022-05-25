<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <div class="navbar-brand col-md-3 col-lg-2 me-0 px-3">
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center link-dark text-capitalize text-decoration-none dropdown-toggle text-warning" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>{{ $user->username }}</strong>
      </a>
      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="">
        <li><a class="dropdown-item" href="#"><span data-feather ="user"></span> Profil</a></li>
        <li><a class="dropdown-item" href="#"><span data-feather ="settings"></span> Settings</a></li>
      </ul>
    </div>
  </div>
  <div class="navbar-nav">
    <form action="{{ route('logoutUser') }}" method="POST">
      @csrf
      <div class="nav-item text-nowrap">
        <button class="btn px-3 text-warning">Keluar <i class="bi bi-box-arrow-right"></i></button>
      </div>
    </form>
  </div>
</header>