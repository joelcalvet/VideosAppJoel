<x-videos-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-4">Videos</h1>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach($videos as $video)
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold">
                            <a href="{{ route('videos.show', $video) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $video->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600">{{ $video->description }}</p>
                        <p class="text-sm text-gray-500 mt-2">Published: {{ $video->formatted_published_at }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $videos->links() }}
            </div>
        </div>
    </div>
</x-videos-app-layout>
