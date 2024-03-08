<!-- resources/views/components/playlist-table.blade.php -->

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
                        <th>Ações</th> <!-- Adicionado a coluna de ações -->
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
                                                <p class="mb-1"><strong>URL:</strong> <a href="{{ $content->url }}" target="_blank">{{ $content->title }}</a></p>
                                                <p class="mb-1"><strong>Autor:</strong> {{ $content->author }}</p>
                                                <p class="mb-1"><strong>Criado em:</strong> {{ $content->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</p>
                                            </div>
                                        </li>
                                    @empty
                                    <li>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addContentModal">
                                            Adicionar Conteúdo
                                        </button>
                                    </li>
                                    @endforelse
                                </ul>
                            </td>
                            <td>
                            <form action="{{ route('playlists.delete', $playlist->id) }}" method="POST" id="deleteForm{{$playlist->id}}">
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{$playlist->id}})">Deletar</button>
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


<script>
    function confirmDelete(playlistId) {
        if (confirm('Tem certeza que deseja deletar?')) {
            document.getElementById('deleteForm' + playlistId).submit();
        }
    }
</script>
