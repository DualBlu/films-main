<!-- resources/views/admin/genres/index.blade.php -->
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Tutti i Generi</h2>
        <div class="text-right mb-3">
            <a href="{{ route('genres.create') }}" class="btn btn-success">Aggiungi Genere</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome
                            <a href="{{route('genres.index',['sort' => $sort === 'name_asc' ? 'name_desc' : 'name_asc' ] ) }}">
                                <i class="fa-solid fa-arrow-{{$sort === 'name_asc' ? 'down' : 'up'}}"></i>
                            </a>

                        </th>
                        <th>Opzioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($genres as $genre)
                    <tr>
                        <td>{{ $genre->name }}</td>
                        <td>
                            <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-primary btn-sm">Modifica</a>
                            <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary btn-sm" onclick="return confirm('Sei sicura di voler eliminare questo genere?')">Elimina</button>
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
                @if ($genres->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $genres->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                @endif

                {{-- Link alle pagine --}}
                @foreach ($genres->getUrlRange(1, $genres->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $genres->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endforeach

                {{-- Link alla pagina successiva --}}
                @if ($genres->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $genres->nextPageUrl() }}" aria-label="Next">
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