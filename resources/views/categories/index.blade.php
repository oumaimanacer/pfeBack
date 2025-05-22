@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Categories</h2>

    <!-- Bouton pour ajouter -->
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addCategoryModal">
        Add Category
    </button>

    <!-- Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Table des catégories -->
    <table class="table">
        <thead>
            <tr><th>Name</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <!-- Bouton Modifier -->
                    <button class="btn btn-warning btn-sm"
                            data-toggle="modal"
                            data-target="#editCategoryModal"
                            data-id="{{ $category->id }}"
                            data-name="{{ $category->name }}">
                        Edit
                    </button>

                    <!-- Supprimer -->
                    <form action="{{ route('categories.destroy', $category->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
</div>

<!-- Modale Ajouter -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ route('categories.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="text" name="name" class="form-control" placeholder="Category name" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modale Éditer -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form method="POST" id="editForm">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="text" name="name" id="editName" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Script JS pour remplir la modale d'édition -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#editCategoryModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');

        $('#editName').val(name);
        $('#editForm').attr('action', '/categories/' + id);
    });
});
</script>
@endsection
