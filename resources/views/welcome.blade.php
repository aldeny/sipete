<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Informasi Penghargaan Pegawai Teladan Dengan Metode SAW">
    <meta name="author" content="Aldeny-KatakSlim">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SiPeTe</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
  </head>
  <body class="text-center">
    
    <main class="form-signin">
    <form action="{{ route('loginUser') }}" method="POST">
      @csrf
      <img class="mb-4 img-fluid" width="25%" src="{{ asset('img/pekanbaru.png') }}" alt="">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating">
        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        <label for="username">Username</label>
        <span class="text-danger">
          @error('username') {{ $message }} @enderror
        </span>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
        <span class="text-danger">
          @error('password') {{ $message }} @enderror
        </span>
      </div>
      <button class="w-100 btn btn-lg btn-primary mb-4" type="submit">Login</button>
    </form>
    </main>

    @include('sweetalert::alert')
  </body>
</html>
