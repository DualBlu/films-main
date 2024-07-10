<!-- resources/views/admin/actors/index.blade.php -->
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Tutti i registi</h2>
        <div class="text-right mb-3">
            <a href="{{ route('directors.create') }}" class="btn btn-success">Aggiungi Regista</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome
                            <a href="{{route('directors.index',['sort' => $sort === 'name_asc' ? 'name_desc' : 'name_asc' ] ) }}">
                                <i class="fa-solid fa-arrow-{{$sort === 'name_asc' ? 'down' : 'up'}}"></i>
                            </a>

                        </th>
                        <th>Nazionalita'</th>
                        <th>Opzioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($directors as $director)
                    <tr>
                        <td>{{ $director->name }}</td>
                        <td>{{ $director->nationality }}</td>
                        <td>
                            <a href="{{ route('directors.edit', $director->id) }}" class="btn btn-primary btn-sm">Modifica</a>
                            <form action="{{ route('directors.destroy', $director->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicura di voler eliminare questo regista?')">Elimina</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination-container">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{-- Link alla pagina precedente --}}
                @if ($directors->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $directors->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                @endif

                {{-- Link alle pagine --}}
                @foreach ($directors->getUrlRange(1, $directors->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $directors->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endforeach

                {{-- Link alla pagina successiva --}}
                @if ($directors->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $directors->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
                @else
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
@endsection