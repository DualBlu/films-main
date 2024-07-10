@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="p-5 bg-light rounded">
                <h2 class="mb-4">Inserisci un nuovo regista</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('directors.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Nome regista -->
                    <div class="form-group mb-3">
                        <label for="name" class="text-primary">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <!-- Nazionalita' regista -->
                    <div class="form-group mb-3">
                        <label for="nationality" class="text-primary">Nazionalita'</label>
                        <input type="text" name="nationality" id="nationality" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection
