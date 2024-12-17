<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">Daftar Buku</h2>

            <!-- Form Pencarian -->
            {{-- <form method="GET" action="{{ route('books.index') }}" class="mb-6">
                <div class="flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari buku berdasarkan judul atau penulis..."
                        class="w-full px-4 py-2 border rounded-l-lg focus:ring focus:ring-indigo-300" />
                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-600">
                        Cari
                    </button>
                </div>
            </form> --}}

            <!-- Search Bar -->
            <div class="flex justify-center mb-6">
                <form method="GET" action="{{ route('books.index') }}" class="relative w-full max-w-md">
                    <!-- Icon Search -->
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 2a6 6 0 100 12A6 6 0 008 2zM0 8a8 8 0 1115.27 4.11l4.31 4.3a1 1 0 01-1.42 1.42l-4.3-4.31A8 8 0 010 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>

                    <!-- Input Field -->
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul atau penulis buku..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent" />

                    <!-- Search Button -->
                    <button type="submit"
                        class="absolute inset-y-0 right-0 px-4 py-2 bg-indigo-500 text-white rounded-r-full hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        Cari
                    </button>
                </form>
            </div>


            <!-- Grid Container -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($books as $book)
                    <div class="bg-white shadow-md rounded-lg p-4 border">
                        <h3 class="text-lg font-semibold mb-2">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600 mb-1">
                            <strong>Penulis:</strong> {{ $book->author }}
                        </p>
                        <p class="text-sm text-gray-600 mb-1">
                            <strong>Tahun:</strong> {{ $book->year }}
                        </p>
                        <p class="text-sm text-gray-600 mb-1">
                            <strong>ISBN:</strong> {{ $book->isbn }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <strong>Salinan:</strong> {{ $book->copies }}
                        </p>
                    </div>
                @empty
                    <p class="col-span-4 text-gray-500">Buku tidak ditemukan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
