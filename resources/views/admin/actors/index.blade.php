<!-- resources/views/admin/actors/index.blade.php -->
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Tutti gli attori</h2>
        <div class="text-right mb-3">
            <a href="{{ route('actors.create') }}" class="btn btn-success">Aggiungi Attore</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome
                            <a href="{{route('actors.index',['sort' => $sort === 'name_asc' ? 'name_desc' : 'name_asc' ] ) }}">
                                <i class="fa-solid fa-arrow-{{$sort === 'name_asc' ? 'down' : 'up'}}"></i>
                            </a>

                        </th>
                        <th>Opzioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actors as $actor)
                    <tr>
                        <td>{{ $actor->name }}</td>
                        <td>
                            <a href="{{ route('actors.edit', $actor->id) }}" class="btn btn-primary btn-sm">Modifica</a>
                            <form action="{{ route('actors.destroy', $actor->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicura di voler eliminare questo attore?')">Elimina</button>
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
                @if ($actors->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $actors->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                @endif

                {{-- Link alle pagine --}}
                @foreach ($actors->getUrlRange(1, $actors->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $actors->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endforeach

                {{-- Link alla pagina successiva --}}
                @if ($actors->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $actors->nextPageUrl() }}" aria-label="Next">
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