<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <link rel="stylesheet" href="/css/app.css">

    <title>Secto-Teca</title>
</head>
<body>

  <!-- Conteúdo da sua aplicação -->
  <div class="container mt-5">
        <a href="#" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#createPlaylistModal">Criar Nova Playlist</a>

        <!-- Modal para criar um playlit -->
        <div class="modal fade" id="createPlaylistModal" tabindex="-1" aria-labelledby="createPlaylistModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPlaylistModalLabel">Criar Nova Playlist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <form action="{{ route('playlists.store') }}" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Título da Playlist</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição da Playlist</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label">Autor da Playlist</label>
                            <input type="text" class="form-control" id="author" name="author">
                        </div>

                        <button type="submit" class="btn btn-primary">Criar Playlist</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>





        <x-playlist-table :playlists="$playlists" />

    </div>

</body>
</html>
