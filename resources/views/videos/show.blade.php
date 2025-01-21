<x-videos-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                {{-- Títol del vídeo --}}
                <h1 class="text-2xl font-bold mb-4 text-gray-800">{{ $video->title }}</h1>

                {{-- Descripció del vídeo --}}
                <p class="text-lg text-gray-700 mb-4">{{ $video->description }}</p>

                {{-- Informació de publicació --}}
                <div class="text-sm text-gray-500 mb-6">
                    <p><span class="font-semibold">Publicat:</span> {{ $video->formatted_published_at }}</p>
                    <p>{{ $video->formatted_for_humans_published_at }}</p>
                </div>

                {{-- Contenidor del vídeo --}}
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
</x-videos-app-layout>
