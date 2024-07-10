@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-body p-5 bg-light rounded">
                    <h2 class="mb-4">Modifica Regista</h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('directors.update', $director->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nome dell'attore -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $director->name }}">
                        </div>

                        <!-- Nazionalita' dell'attore -->
                        <div class="mb-3">
                            <label for="nationality" class="form-label">Nazionalita'</label>
                            <input type="text" name="nationality" id="nationality" class="form-control" value="{{ $director->nationality }}">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
