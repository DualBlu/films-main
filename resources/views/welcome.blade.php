@extends('layouts.app')

@section('content')
<div class="container">
    <div id="carouselExampleCaptions" class="carousel slide mb-3" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                @if (filter_var($films[0]->poster, FILTER_VALIDATE_URL))
                <img src="{{ $films[0]->poster }}" alt="Poster del film" class="img-fluid" style="width: 100%; height: 100vh; object-fit: repeat;">
                @else
                <img src="{{ asset('storage/' . $films[0]->poster) }}" alt="Poster del film" class="img-fluid">
                @endif
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $films[0]->title }}</h5>
                    <p>{{ $films[0]->description }} </p>
                </div>
            </div>
            <div class="carousel-item">
                @if (filter_var($films[1]->poster, FILTER_VALIDATE_URL))
                <img src="{{ $films[1]->poster }}" alt="Poster del film" class="img-fluid" style="width: 100%; height: 100vh; object-fit: repeat;">
                @else
                <img src="{{ asset('storage/' . $films[1]->poster) }}" alt="Poster del film" class="img-fluid">
                @endif
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $films[1]->title }}</h5>
                    <p>{{ $films[1]->description }} </p>
                </div>
            </div>
            <div class="carousel-item">
                @if (filter_var($films[2]->poster, FILTER_VALIDATE_URL))
                <img src="{{ $films[2]->poster }}" alt="Poster del film" class="img-fluid" style="width: 100%; height: 100vh; object-fit: repeat;">
                @else
                <img src="{{ asset('storage/' . $films[2]->poster) }}" alt="Poster del film" class="img-fluid">
                @endif
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $films[2]->title }}</h5>
                    <p>{{ $films[2]->description }} </p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="row">
        @foreach ($films as $film)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <div class="film-poster overflow-hidden">
                    @if (filter_var($film->poster, FILTER_VALIDATE_URL))
                    <img src="{{ $film->poster }}" alt="Poster del film" class="img-fluid">
                    @else
                    <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster del film" class="img-fluid">
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $film->title }}</h5>
                    <p class="card-text"><strong>Regista:</strong> {{ $film->director->name }}</p>
                    <p class="card-text"><strong>Attori:</strong></p>
                    <ul class="list-unstyled">
                        @foreach ($film->actors as $actor)
                        <li>{{ $actor->name }}</li>
                        @endforeach
                    </ul>
                    <p class="card-text"><strong>Generi:</strong></p>
                    <ul class="list-unstyled">
                        @foreach ($film->genres as $genre)
                        <li>{{ $genre->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Paginazione -->
    <div class="pagination-container">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{-- Link alla pagina precedente --}}
                @if ($films->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $films->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                @endif

                {{-- Link alle pagine --}}
                @foreach ($films->getUrlRange(1, $films->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $films->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endforeach

                {{-- Link alla pagina successiva --}}
                @if ($films->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $films->nextPageUrl() }}" aria-label="Next">
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

    {{-- Mostra i risultati --}}
    <div class="text-center">
        <p>
            {{ __('pagination.showing_results', [
                'first' => $films->firstItem(),
                'last' => $films->lastItem(),
                'total' => $films->total(),
            ]) }}
        </p>
    </div>

</div>

@endsection