@extends('layouts.app')

@section('content')
<div class="container">
    {{-- @dd($films) --}}
    <h2>Risultati di ricerca</h2>
    <div class="row">
        @if($films->isEmpty())
         <h2>Non ci sono risultati</h2>
        @else
       @foreach($films as $film)
       <div class="col-md-4">
            <div class="card">
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
                </div>
            </div>
       </div>
       @endforeach
       @endif
    </div>
</div>

@endsection