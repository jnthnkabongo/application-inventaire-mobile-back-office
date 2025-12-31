@extends('layouts.entete-head')
@section('content')
    <div class="container my-5">
        <h1 class="text-center ">Tableau des matériels</h1>

        <div class="row justify-content-center mb-2">
            <!-- Administrateurs -->
            <div class="col-lg-4 col-md-6 col-sm-12 my-4">
                <a href="" class="text-decoration-none text-dark">
                    <div class="card text-center shadow-sm border-0 rounded-4 h-100 hover-card">
                        <div class="card-body py-4">
                            <div class="mb-3 text-warning">
                                <i class="bi bi-shield-lock-fill" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold">Materiels en bon etat</h5>
                            <p class="card-text display-6 fw-semibold text-dark">
                                6
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Utilisateur -->
            <div class="col-lg-4 col-md-6 col-sm-12 my-4">
                <a href="" class="text-decoration-none text-dark">
                    <div class="card text-center shadow-sm border-0 rounded-4 h-100 hover-card">
                        <div class="card-body py-4">
                            <div class="mb-3 text-success">
                                <i class="bi bi-people-fill" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold">Matériel en moyen etat</h5>
                            <p class="card-text display-6 fw-semibold text-dark">
                                5
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 my-4">
                <a href="" class="text-decoration-none text-dark">
                    <div class="card text-center shadow-sm border-0 rounded-4 h-100 hover-card">
                        <div class="card-body py-4">
                            <div class="mb-3 text-success">
                                <i class="bi bi-people-fill" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold">Matériel en mauvais etat</h5>
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
                        <th scope="col">Type matériel</th>
                        <th scope="col">Région</th>
                        <th scope="col">Shop</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Modèle</th>
                        <th scope="col">Numéro série</th>
                        <th scope="col">Etat</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($liste_materiels as $materiels)
                        <tr>
                            <td>{{ ($liste_materiels->perPage() * ($liste_materiels->currentPage() - 1 ))+ $loop->iteration }}</td>
                            <td>{{ Str::ucfirst($materiels->Type_materiel->name) }}</td>
                            <td>{{ Str::ucfirst($materiels->Regions->name) }}</td>
                            <td>{{ Str::ucfirst($materiels->Shops->name) }}</td>
                            <td>{{ Str::ucfirst($materiels->marque) }}</td>
                            <td>{{ Str::ucfirst($materiels->modele) }}</td>
                            <td>{{ Str::ucfirst($materiels->numero_serie) }}</td>
                            <td>
                                <span class="badge bg-primary text-uppercase">
                                    {{ Str::ucfirst($materiels->Etat_Mate->name) }}
                                </span>
                            </td>
                            <td>
                                @if($materiels->photo && file_exists(public_path('/' . $materiels->photo)))
                                    <img src="{{ asset('/' . $materiels->photo) }}"
                                        alt="Photo du matériel"
                                        width="60"
                                        height="60"
                                        style="object-fit: cover; border-radius: 5px;">
                                @else
                                    <span class="text-muted">Aucune image</span>
                                @endif
                            </td>
                            <td class="text-center d-flex gap-1 row">
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
                    {{ $liste_materiels->withQueryString()->links() }}
                </li>
            </ul>
        </nav>
    </div>
@endsection
