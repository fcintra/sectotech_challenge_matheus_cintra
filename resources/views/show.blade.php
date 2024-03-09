<!-- resources/views/playlists/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes da Playlist</h1>

        <div>
            <strong>Nome:</strong> {{ $playlist->title }}
        </div>

        <div>
            <strong>Descrição:</strong> {{ $playlist->description }}
        </div>

        <!-- Adicione mais detalhes conforme necessário -->

        <!-- Exibir os conteúdos da playlist -->
        <h2>Conteúdos</h2>
        <ul>
            @forelse ($playlist->contents as $content)
                <li>
                    <p><strong>Título:</strong> {{ $content->title }}</p>
                    <p><strong>URL:</strong> <a href="{{ $content->url }}" target="_blank">{{ $content->url }}</a></p>
                    <!-- Adicione mais detalhes conforme necessário -->
                </li>
            @empty
                <li>Nenhum conteúdo disponível.</li>
            @endforelse
        </ul>
    </div>
@endsection
