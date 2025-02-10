@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Gestió de Vídeos</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Reproductor de Vídeo</h5>

                <!-- Embedding d'un vídeo de YouTube -->
                <div class="mt-6 flex justify-center">
                    <iframe
                        class="rounded-lg shadow-md"
                        width="560"
                        height="315"
                        src="{{ str_replace('watch?v=', 'embed/', str_replace('m.youtube.com', 'www.youtube.com', $video->url)) }}"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
