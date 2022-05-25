<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}" aria-current="page" href="{{ route('beranda') }}">
          <span data-feather="home"></span>
          Beranda
        </a>
      </li>
      @if ($user->jabatan_id == 1)
      <li class="nav-item">
        <a class="nav-link {{ (request()->is('user*')) ? 'active' : '' }}" href="{{ route('data_user') }}">
          <span data-feather="user"></span>
          Data User
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (request()->is('kriteria*')) ? 'active' : '' }}" href="{{ route('data_kriteria') }}">
          <span data-feather="server"></span>
          Kriteria
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (request()->is('pegawai*')) ? 'active' : '' }}" href="{{ route('data_pegawai') }}">
          <span data-feather="users"></span>
          Pegawai
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (request()->is('penilaian*')) ? 'active' : '' }}" href="{{ route('data_penilaian') }}">
          <span data-feather="award"></span>
          Penilaian
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (request()->is('saw*')) ? 'active' : '' }}" href="{{ route('data_saw') }}">
          <span data-feather="clipboard"></span>
          Metode Saw
        </a>
      </li>
      @elseif($user->jabatan_id == 2)
      <li class="nav-item">
        <a class="nav-link {{ (request()->is('pengajuan*')) ? 'active' : '' }}" href="{{ route('data_pengajuan') }}">
          <span data-feather="clipboard"></span>
          Pengajuan
        </a>
      </li>
      @endif
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Saved reports</span>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Current month
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Last quarter
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Social engagement
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Year-end sale
        </a>
      </li>
    </ul>
  </div>
</nav>