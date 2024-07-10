@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Films del genere: {{ $genre->name }}</h2>

    <div class="row">
        @foreach ($films as $film)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                @if (filter_var($film->poster, FILTER_VALIDATE_URL))
                <img src="{{ $film->poster }}" class="card-img-top" alt="{{ $film->title }}">
                @elseif($film->poster === null)
                <img src="https://cdn.pixabay.com/photo/2023/08/11/16/50/water-8183918_1280.jpg" class="card-img-top"
                    alt="{{ $film->title }}">
                @else
                <img src="{{ asset('storage/posters/' . $film->poster) }}" class="card-img-top" alt="{{ $film->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $film->title }}</h5>
                    <p class="card-text">{{ $film->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

   
</div>
@endsection
