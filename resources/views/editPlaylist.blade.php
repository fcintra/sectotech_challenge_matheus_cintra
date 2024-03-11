@props(['playlist'])

@isset($playlist)

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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mt-4 mb-4">Editar Playlist</h2>
        <a href="/" class="btn btn-primary">Voltar à Tela Inicial</a>
    </div>

    <form id="form-playlist" action="{{ route('updatePlaylist', $playlist->id) }}" method="POST">
        @method('PUT')

        <!-- Playlist Details -->
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="playlist-titulo" class="form-control" name="title" value="{{ $playlist->title }}" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Autor:</label>
            <input type="text" id="playlist-author" class="form-control" name="author" value="{{ $playlist->author }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea id="playlist-description" class="form-control" name="description" required>{{ $playlist->description }}</textarea>
        </div>

        <button type="submit" id="btn-update-playlist" class="btn btn-success">Atualizar Playlist</button>

    </form>

    <hr class="mb-4">

     @if(count($playlist->contents) > 0)
        <h3 class="mt-4 mb-4">Editar Conteúdos</h3>
        @foreach ($playlist->contents as $content)
            <form id="form-{{ $content->id }}" class="content-form">
                @method('PUT')
                <!-- Contents -->
                <div class="mb-3">
                    <label for="title" class="form-label">Conteúdo - Título:</label>
                    <input type="text" class="form-control content-input" name="title" value="{{ $content->title }}" required>
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">Conteúdo - URL:</label>
                    <input type="text" class="form-control content-input" name="url" value="{{ $content->url }}" required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Conteúdo - Autor:</label>
                    <input type="text" class="form-control content-input" name="author" value="{{ $content->author }}" required>
                </div>
                <button type="button" class="btn btn-success" onclick="saveFormValues({{ $content->id }})">Atualizar Conteúdo</button>
                <hr class="mb-4">
            </form>
        @endforeach
    @endif
</div>

</body>
</html>

@endisset

<script>
    // Função autoinvocável para evitar poluição global
    (function() {
        // Objeto para armazenar os valores dos formulários
        var formValues = {};

        // Função para salvar os valores do formulário com base no ID
window.saveFormValues = function(contentId) {
    var formId = "form-" + contentId;
    var formData = $("#" + formId).serializeArray();

    // Iterar sobre os elementos do formulário e atualizar os valores nos atributos data-*
    formData.forEach(function(input) {
        var inputElement = $('[name="' + input.name + '"]', '#' + formId);
        inputElement.data('original-value', inputElement.val()); // Armazenar o valor original
        inputElement.data('new-value', input.value); // Armazenar o novo valor
    });

    // Exibir os valores salvos (pode ser removido em produção)
    console.log("Valores salvos:", formData, "ID:", contentId);

    // Chamada AJAX para enviar os valores ao servidor
    $.ajax({
        type: 'PUT',
        url: '/contents/' + contentId,
        data: formData,
        success: function(response) {
            alert('Conteúdo atualizado com sucesso!');
        },
        error: function(error) {
            console.error(error);
            alert('Erro ao atualizar o conteúdo. Por favor, tente novamente.');
        }
    });
};
    })();
</script>


<script>
    $(document).ready(function() {
        // Evento de envio do formulário
        $("#form-playlist").submit(function(e) {
            e.preventDefault(); // Impede o envio padrão do formulário

            // Serializa os dados do formulário
            var formData = $(this).serialize();

            // Envia a requisição AJAX para atualizar a playlist
            $.ajax({
                type: 'PUT',
                url: '{{ route("updatePlaylist", $playlist->id) }}',
                data: formData,
                success: function(response) {
                    console.log(response);

                    alert('Playlist atualizada com sucesso!');
                },
                error: function(error) {
                    console.error(error);
                    alert('Erro ao atualizar a playlist. Por favor, tente novamente.');
                }
            });
        });
    });
</script>
