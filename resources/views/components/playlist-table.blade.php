
@props(['playlists'])

@isset($playlists)

    <div class="card">
        <div class="card-body">
            <h1>Lista de Playlists</h1>

            <table class="table">
                <thead>
                    <tr>
                        <th>Autor</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Conteúdos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($playlists as $playlist)
                        <tr>
                            <td>{{ $playlist->author }}</td>
                            <td>{{ $playlist->title }}</td>
                            <td>{{ $playlist->description }}</td>
                            <td>
                                <ul class="list-unstyled">
                                    @forelse ($playlist->contents as $content)
                                        <li class="mb-3">
                                            <div class="content-item">
                                                <p class="mb-1"><strong>URL:</strong> <a href="{{ $content->url }}" target="_blank">{{ $content->url }}</a></p>
                                                <p class="mb-1"><strong>Autor:</strong> {{ $content->author }}</p>
                                                <p class="mb-1"><strong>Criado em:</strong> {{ $content->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</p>
                                            </div>
                                        </li>
                                    @empty
                                    <li>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addContentModal" onclick="setPlaylistId({{ $playlist->id }})">
                                            Adicionar Conteúdo
                                        </button>
                                    </li>
                                    @endforelse
                                </ul>
                            </td>
                            <td>
                            <form action="{{ route('playlists.delete', $playlist->id) }}" method="POST" id="deleteForm{{$playlist->id}}">
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $playlist->id }}, '{{ $playlist->title }}')">Deletar</button>
                                @if (count($playlist->contents) > 0)
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addContentModal" onclick="setPlaylistId({{ $playlist->id }})">
                                        Adicionar Conteúdo
                                    </button>
                                @endif
                            </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Nenhuma playlist encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@else

    <span colspan="5">Nenhuma playlist encontrada.</span>

@endisset


<div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mr-4" id="addContentModalLabel">Adicionar Conteúdo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="content-form">
                    @include('components.content-form')
                    <hr class="my-4">
                    <button type="button" class="btn btn-success ms-2" onclick="sendFormData()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>



<script>

    function setPlaylistId(playlistId) {
        document.getElementById('playlistId').value = playlistId;
    }

    function sendFormData() {
        const formData = new FormData(document.getElementById('addContentForm'));
        const formDataObject = {};
        formData.forEach((value, key) => {
            formDataObject[key] = value;
        });


        $.ajax({
            type: 'POST',
            url: '{{ route("contents.store") }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                $('#addContentModal').modal('hide');
                location.reload()
            },
            error: function (error) {
                console.error(error);
            },
        });
    }


    function confirmDelete(playlistId, playlistTitle) {
        if (confirm(`Tem certeza que deseja deletar a playlist "${playlistTitle}"?`)) {
            document.getElementById('deleteForm' + playlistId).submit();
        }
    }
</script>
