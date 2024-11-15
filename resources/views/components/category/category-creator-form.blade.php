<!-- resources/views/category/create.blade.php -->
<form action="{{ route('category.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Add Category</button>
</form>