<x-layout>
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label" for="category">Category</label>
            <select name="category" class="form-select" required>
                <option value="" selected>Choose...</option>
@foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->verbose_name }}</option>
@endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="priority">Priority</label>
            <input type="number" name="priority" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="tags">Tags</label>
            <input type="text" name="tags" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <input type="text" name="description" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="thumbnail">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control" accept="image/png, image/jpeg" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="content">content</label>
            <textarea name="content" class="form-control" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-lg btn-primary my-3">
            Submit
        </button>
    </form>
    <script src="/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({ selector: 'textarea[name="content"]' })
    </script>
</x-layout>