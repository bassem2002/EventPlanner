@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Liste des catégories</h1>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" style="margin-bottom:15px;">➕ Ajouter une catégorie</a>

    @if(session('success'))
        <div class="alert alert-success" style="color:green; margin-top:10px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container" style="overflow-x:auto;">
        <table class="categories-table" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background-color:#f0f0f0; text-align:left;">
                    <th style="padding:10px;">#</th>
                    <th style="padding:10px;">Nom</th>
                    <th style="padding:10px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $cat->id }}</td>
                        <td style="padding:10px;">{{ $cat->name }}</td>
                        <td style="padding:10px;">
                            <a href="{{ route('admin.categories.edit', $cat->id) }}" style="margin-right:10px; color:#1d4ed8; text-decoration:none;">✏️ Éditer</a>

                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Êtes-vous sûr ?')" style="background:none; border:none; color:#dc2626; cursor:pointer;">🗑️ Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:20px; text-align:center; color:#888;">
                            Aucune catégorie
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $categories->links() }}
    </div>
</div>
@endsection
