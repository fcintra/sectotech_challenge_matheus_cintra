@props(['playlist'])

@isset($playlist)

   <!-- resources/views/editPlaylist.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Edit Playlist - Secto-Teca</title>
</head>
<body>

<div class="container">
        <h2 class="mt-4 mb-4">Edit Playlist</h2>
        <form action="{{ route('updatePlaylist', $playlist->id) }}" method="POST">
            @method('PUT')

            <!-- Playlist Details -->
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" name="title" value="{{ $playlist->title }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" name="description" required>{{ $playlist->description }}</textarea>
            </div>

            <!-- Contents -->
            <h3>Playlist Contents</h3>
            @foreach ($playlist->contents as $content)
                <div class="mb-3">
                    <label for="content_title" class="form-label">Content Title:</label>
                    <input type="text" class="form-control" name="content_title[]" value="{{ $content->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="content_url" class="form-label">Content URL:</label>
                    <input type="text" class="form-control" name="content_url[]" value="{{ $content->url }}" required>
                </div>


                <hr class="mb-4">
            @endforeach

            <button type="submit" class="btn btn-primary">Update Playlist</button>
        </form>
    </div>
</body>
</html>

@endisset
