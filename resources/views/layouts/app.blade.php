<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Biblioteca de Yasmina</title>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
  <!-- CSS de Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <!-- JavaScript de Bootstrap -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  

</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('books.index') }}">Listado</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('books.create') }}">Añadir libro</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.index') }}">Gestión de categorías</a>
          </li>
        </ul>
        <span class="footer-text">UF3 Práctica 2 Yasmina Ajouau</span>
      </div>
    </nav>
  </header>

  @yield('content')
  @yield('scripts')
</body>

</html>

<style>
  .nav-link:hover {
    font-weight: 700;
  }

  .footer-text {
    color: darkgray;
    position: absolute;
    right: 20px;
    font-style: italic;
  }
</style>