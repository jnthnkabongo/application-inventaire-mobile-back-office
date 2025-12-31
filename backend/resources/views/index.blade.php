@extends('layouts.entete-head')
@section('content')


    <div class="container mt-5">
        <div class="row g-4">

            <!-- Card 1 -->
            <div class="col-12 col-sm-6 col-lg-4 col-xl">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Utilisateurs</h6>
                            <h3 class="fw-bold text-primary">{{ $sommes_users}}</h3>
                        </div>
                        <div class="fs-1 text-primary">
                            👤
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-12 col-sm-6 col-lg-4 col-xl">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Matériels</h6>
                            <h3 class="fw-bold text-primary">{{ $sommes_materiels}}</h3>
                        </div>
                        <div class="fs-1 text-primary">
                            💻
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-12 col-sm-6 col-lg-4 col-xl">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Régions</h6>
                            <h3 class="fw-bold text-primary">{{ $sommes_regions}}</h3>
                        </div>
                        <div class="fs-1 text-warning">
                            📍
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-12 col-sm-6 col-lg-6 col-xl">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Shop & DC...</h6>
                            <h3 class="fw-bold text-primary">{{ $sommes_shop }}</h3>
                        </div>
                        <div class="fs-1 text-info">
                            🏪
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="col-12 col-sm-6 col-lg-6 col-xl">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Incidents</h6>
                            <h3 class="fw-bold text-danger">{{ $liste_materiels_incedents}}</h3>
                        </div>
                        <div class="fs-1 text-danger">
                            ⚠️
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white d-flex flex-wrap align-items-center justify-content-center">
                <div class="row g-2 flex-grow-1 d-flex align-items-center justify-content-center">
                    <!-- Type matériel -->
                    <div class="col-auto">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-laptop"></i></span>
                            <select class="form-select" id="filter-type">
                                <option value="">Type matériel</option>
                                @foreach($typesMateriel as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- État -->
                    <div class="col-auto">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-circle-fill"></i></span>
                            <select class="form-select" id="filter-etat">
                                <option value="">État</option>
                                <option value="1">Très bon</option>
                                <option value="2">Bon</option>
                                <option value="3">Légèrement bon</option>
                                <option value="4">Mauvais</option>
                            </select>
                        </div>
                    </div>

                    <!-- Région -->
                    <div class="col-auto">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <select class="form-select" id="filter-region">
                                <option value="">Région</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Shop -->
                    <div class="col-auto">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shop"></i></span>
                            <select class="form-select" id="filter-shop">
                                <option value="">Shop/DC</option>
                                @foreach($shops as $shop)
                                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Utilisateur -->
                    <div class="col-auto">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <select class="form-select" id="filter-user">
                                <option value="">Utilisateur</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive shadow-sm rounded-4 bg-white ">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Type Matériel</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Modèle</th>
                        <th scope="col">Numéro série</th>
                        <th scope="col">État</th>
                        <th scope="col">Région</th>
                        <th scope="col">Shop</th>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($liste_materiels as $materiel)
                        <tr>
                            <td>{{ ($liste_materiels->perPage() * ($liste_materiels->currentPage() - 1 ))+ $loop->iteration }}</td>
                            <td>{{ $materiel->Type_materiel->name ?? '-'}}</td>
                            <td>{{ $materiel->marque}}</td>
                            <td>{{ $materiel->modele}}</td>
                            <td>{{ $materiel->numero_serie}}</td>
                            <td>{{ $materiel->Etat_Mate->name ?? '-'}}</td>
                            <td>{{ $materiel->Regions->name ?? '-'}}</td>
                            <td>{{ $materiel->Shops->name ?? '-'}}</td>
                            <td>{{ $materiel->User->name ?? '-'}}</td>
                            {{-- <td>
                                @if($materiel->photo)
                                    <img src="{{ asset('materiels/photos/' . $materiel->photo) }}"
                                        alt="Photo du matériel"
                                        width="80"
                                        height="80"
                                        style="object-fit: cover; border-radius: 5px;">
                                @else
                                    <span class="text-muted">Aucune image</span>
                                @endif
                            </td> --}}
                            <td>
                                @if($materiel->photo && file_exists(public_path('/' . $materiel->photo)))
                                    <img src="{{ asset('/' . $materiel->photo) }}"
                                        alt="Photo du matériel"
                                        width="60"
                                        height="60"
                                        style="object-fit: cover; border-radius: 5px;">
                                @else
                                    <span class="text-muted">Aucune image</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <form method="GET" action="">
                                        <button class="btn btn-sm btn-dark text-white">👁</button>
                                    </form>

                                    <form method="GET" action="">
                                        <button class="btn btn-sm btn-dark text-white">✏️</button>
                                    </form>

                                    <form method="POST" action=""
                                        onsubmit="return confirm('Supprimer ce matériel ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑</button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Aucun matériel trouvé
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
</div>

</div>
@endsection

