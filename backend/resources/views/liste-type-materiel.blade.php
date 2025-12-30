@extends('layouts.entete-head')
@section('content')
     <div class="container my-5">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6"></div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <h1 class="text-center ">Tableau des shops</h1>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <a class="btn btn-primary" href=""><i class="bi bi-gear-fill me-2"></i> Ajouter une type de matériel</a>
            </div>
        </div>

        <div class="table-responsive shadow-sm rounded-4 bg-white">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Type de matériel</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($liste_type_mate as $materiels)
                        <tr>
                            <td>{{ ($liste_type_mate->perPage() * ($liste_type_mate->currentPage() - 1 ))+ $loop->iteration }}</td>
                            <td>{{ Str::ucfirst($materiels->name) }}</td>
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

    </div>
@endsection
