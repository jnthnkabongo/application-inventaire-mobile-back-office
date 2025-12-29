{{-- <!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Application Support</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      padding-top: 80px; /* espace pour le header fixe */
      background-color: #f8f9fa;
    }

    .navbar-brand {
      color: #000 !important;
    }

    .navbar-nav .nav-link {
      color: #000 !important;
      font-weight: 500;
    }

    .dropdown-menu {
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .dropdown-item:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>

<body>

  <!-- Header -->
  <nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm">
    <div class="container">
      <!-- Nom de l’application -->
      <a class="navbar-brand fw-bold" href="">
        Dashboard inventaire
      </a>
      <a class="navbar-brand fw-bold" href="">Matériels</a>
      <!-- Bouton responsive -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">

          <!-- Menu utilisateur connecté -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{('images/11.jpeg')}}" alt="Avatar" class="rounded-circle me-2" width="35" height="35">
              <span class="fw-semibold">
                {{ Auth::user()->name ?? 'Utilisateur' }}
              </span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item" href="">
                  <i class="bi bi-person me-2"></i> Mon profil
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="" method="POST" class="d-inline">
                  @csrf
                  <button class="dropdown-item text-danger" type="submit">
                    <i class="bi bi-box-arrow-right me-2"></i> Se déconnecter
                  </button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    @yield('content')
  </div>

  <!-- Bootstrap JS + Icons -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</body>
</html> --}}


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Application Support</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      padding-top: 80px; /* espace pour le header fixe */
      background-color: #f8f9fa;
    }

    .navbar-brand {
      color: #000 !important;
    }

    .navbar-nav .nav-link {
      color: #000 !important;
      font-weight: 500;
    }

    .dropdown-menu {
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .dropdown-item:hover {
      background-color: #f1f1f1;
    }

    /* Styles pour la sidebar */
    .sidebar {
      width: 250px;
      position: fixed;
      top: 60px; /* Pour laisser de l'espace pour le header */
      bottom: 0;
      left: 0;
      background-color: #ffffff;
      padding: 15px;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      margin-bottom: 2px;
      margin-top: 20px;
    }

    .content {
      margin-left: 250px; /* Espace pour la sidebar */
      padding: 5px;
    }
    .sidebar h5 {
    margin-bottom: 40px;
    padding-bottom: 80px; /* Espace sous le titre */
    font-weight: bold; /* Met en gras le titre */
  }

  .nav-item {
    margin-bottom: 10px; /* espace entre les éléments */
  }

  .nav-link {
    color: #333;
    padding: 10px;
    border-radius: 5px; /* Coins arrondis */
    transition: background-color 0.3s; /* Effet de transition */
  }

  .nav-link:hover {
    background-color: #007bff; /* Couleur d'arrière-plan au survol */
    color: white; /* Couleur du texte au survol */
  }

  .nav-link i {
    font-size: 20px; /* Taille des icônes */
  }
  </style>
</head>

<body>

  <!-- Header -->
  <nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ route('administration')}}">Dashboard inventaire</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{('images/11.jpeg')}}" alt="Avatar" class="rounded-circle me-2" width="35" height="35">
              <span class="fw-semibold">{{ Auth::user()->name ?? 'Utilisateur' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href=""><i class="bi bi-person me-2"></i> Mon profil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="" method="POST" class="d-inline">
                  @csrf
                  <button class="dropdown-item text-danger" type="submit">
                    <i class="bi bi-box-arrow-right me-2"></i> Se déconnecter
                  </button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

 <!-- Sidebar -->
<div class="sidebar">
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('administration')}}">
        <i class="bi bi-house-door me-2"></i> Accueil
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('liste-materiels')}}">
        <i class="bi bi-box-seam me-2"></i> Matériels
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('rapport')}}">
        <i class="bi bi-file-earmark-text me-2"></i> Rapports
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('liste-utilisateurs')}}">
        <i class="bi bi-person-circle me-2"></i> Utilisateurs
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('liste-regions')}}">
        <i class="bi bi-globe2 me-2"></i> Régions
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('liste-shops')}}">
        <i class="bi bi-shop me-2"></i> Shops
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('liste-type-materiels')}}">
        <i class="bi bi-gear-fill me-2"></i> Type Matériel
      </a>
    </li>
  </ul>
</div>

  <!-- Contenu principal -->
  <div class="content">
    @yield('content')
  </div>

  <!-- Bootstrap JS + Icons -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</body>
</html>

