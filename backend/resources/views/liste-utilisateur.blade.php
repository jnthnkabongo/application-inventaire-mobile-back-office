@extends('layouts.entete-head')
@section('content')

    <div class="container my-5">
         <div class="container my-5">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6"></div>
            <div class="col-lg-6 col-md-4 col-sm-6">
                <h1 class="text-center ">Tableau des utilisateurs</h1>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a class="btn btn-primary" href=""><i class="bi bi-person-circle me-2"></i> Ajouter un utilisateur</a>
            </div>
        </div>

        <div class="row justify-content-center mb-2">
            <!-- Administrateurs -->
            <div class="col-lg-5 col-md-6 col-sm-12 my-4">
                <a href="" class="text-decoration-none text-dark">
                    <div class="card text-center shadow-sm border-0 rounded-4 h-100 hover-card">
                        <div class="card-body py-4">
                            <div class="mb-3 text-warning">
                                <i class="bi bi-shield-lock-fill" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold">Administrateurs</h5>
                            <p class="card-text display-6 fw-semibold text-dark">
                                6
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Utilisateur -->
            <div class="col-lg-5 col-md-6 col-sm-12 my-4">
                <a href="" class="text-decoration-none text-dark">
                    <div class="card text-center shadow-sm border-0 rounded-4 h-100 hover-card">
                        <div class="card-body py-4">
                            <div class="mb-3 text-success">
                                <i class="bi bi-people-fill" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold">Utilisateurs</h5>
                            <p class="card-text display-6 fw-semibold text-dark">
                                5
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="table-responsive shadow-sm rounded-4 bg-white">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rôle</th>
                        <th scope="col">Région</th>
                        <th scope="col">Date de création</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($liste_users as $utilisateur)
                        <tr>
                            <td>{{ ($liste_users->perPage() * ($liste_users->currentPage() - 1 ))+ $loop->iteration }}</td>
                            <td>{{ $utilisateur->name }}</td>
                            <td>{{ $utilisateur->email }}</td>
                            <td>
                                <span class="badge bg-primary text-uppercase">
                                    {{ $utilisateur->Roles->name }}
                                </span>
                            </td>
                            <td>{{ $utilisateur->Regions->name }}</td>
                            <td>{{ $utilisateur->created_at }}</td>
                            <td class="text-center d-flex gap-1">
                                <form method="GET" action="">
                                    <button class="btn btn-sm btn-dark text-white">👁</button>
                                </form>

                                <form method="GET" action="">
                                    <button class="btn btn-sm btn-dark text-white">✏️</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                Aucune plainte enregistrée pour le moment.
                            </td>
                        </tr>
                        @endforelse
                </tbody>
            </table>
        </div>
        <nav class="app-pagination">
            <ul class="pagination justify-content-center mt-2 pb-2">
                <li class="page-item disabled">
                    {{ $liste_users->withQueryString()->links() }}
                </li>
            </ul>
        </nav>
    </div>

@endsection
