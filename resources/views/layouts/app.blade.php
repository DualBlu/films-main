<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FilmDB Style Layout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Welcome to our FilmDB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-5 me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{Request::routeIs('home') ? 'active' : ''}}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::routeIs('admin.dashboard') ? 'active' : ''}}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::routeIs('email') ? 'active' : ''}}" href="{{ route('email') }}">Contatti</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gestione
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('films.index') }}">Film</a>
                            <a class="dropdown-item" href="{{ route('genres.index') }}">Generi</a>
                            <a class="dropdown-item" href="{{ route('directors.index') }}">Registi</a>
                            <a class="dropdown-item" href="{{ route('actors.index') }}">Attori</a>
                        </ul>
                    </li>
                </ul>
                <form id="searchForm" class="d-flex" action="{{ route('films.search') }}" method="GET">
                    <input id="searchInput" class="form-control me-2" type="search" placeholder="Cerca un film" aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit">Cerca</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">

    </section>

    <!-- Content Section -->
    <section class="content-section py-5">
        <div class="container">
            @yield('content')
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="container text-center">
            <p>&copy; 2024 Filmix. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>