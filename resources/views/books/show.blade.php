<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ $book->title }}</h1>
                <p class="text-lg text-gray-600 mb-2"><strong>Penulis:</strong> {{ $book->author }}</p>
                <p class="text-lg text-gray-600 mb-2"><strong>Tahun:</strong> {{ $book->year }}</p>
                <p class="text-lg text-gray-600 mb-2"><strong>ISBN:</strong> {{ $book->isbn }}</p>
                <p class="text-lg text-gray-600 mb-2"><strong>Salinan:</strong> {{ $book->copies }}</p>
                @if ($book->detail)
                    <p class="text-lg text-gray-600 mb-2"><strong>Genre:</strong> {{ $book->detail->genre }}</p>
                    <p class="text-lg text-gray-600"><strong>Deskripsi:</strong> {{ $book->detail->description }}</p>
                @else
                    <p class="text-lg text-gray-600"><em>Detail tidak tersedia.</em></p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>