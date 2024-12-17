<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">Daftar Buku</h2>

            <!-- Grid Container -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($books as $book)
                    <div class="bg-white shadow-md rounded-lg p-4 border">
                        <!-- Judul Buku -->
                        <h3 class="text-lg font-semibold mb-2">{{ $book->title }}</h3>

                        <!-- Penulis -->
                        <p class="text-sm text-gray-600 mb-1">
                            <strong>Penulis:</strong> {{ $book->author }}
                        </p>

                        <!-- Tahun -->
                        <p class="text-sm text-gray-600 mb-1">
                            <strong>Tahun:</strong> {{ $book->year }}
                        </p>

                        <!-- ISBN -->
                        <p class="text-sm text-gray-600 mb-1">
                            <strong>ISBN:</strong> {{ $book->isbn }}
                        </p>

                        <!-- Salinan -->
                        <p class="text-sm text-gray-600">
                            <strong>Salinan:</strong> {{ $book->copies }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
