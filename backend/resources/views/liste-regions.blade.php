@extends('layouts.entete-head')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6"></div>
            <div class="col-lg-6 col-md-4 col-sm-6">
                <h1 class="text-center ">Tableau des régions</h1>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="" class="btn btn-primary w-100"><i class="bi bi-globe2 me-2"></i> Ajouter une région</a>
            </div>
        </div>

        <div class="table-responsive shadow-sm rounded-4 bg-white">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Région</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($liste_regions as $regions)
                        <tr>
                            <td>{{ ($liste_regions->perPage() * ($liste_regions->currentPage() - 1 ))+ $loop->iteration }}</td>
                            <td>{{ Str::ucfirst($regions->name) }}</td>
                            <td class="text-center d-flex gap-1 ">
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
                    {{ $liste_regions->withQueryString()->links() }}
                </li>
            </ul>
        </nav>
    </div>
@endsection
