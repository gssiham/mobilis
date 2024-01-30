@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un Article</h1>

    <form method="POST" action="{{ route('articles.store') }}">
        @csrf

        <div class="mb-3">
            <label for="code_bar" class="form-label">Code Bare</label>
            <input type="number" class="form-control" id="code_bar" name="code_bar" required>
        </div>

        <div class="mb-3">
            <label for="designation" class="form-label">Designation</label>
            <input type="text" class="form-control" id="designation" name="designation" required>
        </div>

        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="number" class="form-control" id="quantite" name="quantite" required>
        </div>

        <!-- Dropdown for selecting a single office -->
        <div class="mb-3">
            <label for="office_id" class="form-label">Sélectionner un Bureau</label>
            <select class="form-control" id="office_id" name="office_id">
                @foreach($offices as $office)
                    <option value="{{ $office->id }}">{{ $office->num_bureau }}</option> <!-- Replace 'name' with the office attribute you want to display -->
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
