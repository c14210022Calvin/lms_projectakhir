<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Judul Halaman -->
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Daftar Buku</h2>

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
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />

                    <!-- Search Button -->
                    <button type="submit"
                        class="absolute inset-y-0 right-0 px-4 py-2 bg-indigo-500 text-white rounded-r-full hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Button Tambah Buku -->
            @if (Auth::user()->role === 'admin')
                <div class="flex justify-end mb-4">
                    <a href="{{ route('books.create') }}"
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition ease-in-out duration-300">
                        Tambah Buku
                    </a>
                </div>
            @endif

            <!-- Grid Container -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 items-start">
                @forelse ($books as $book)
                    <div
                        class="bg-white shadow-lg rounded-lg p-5 border hover:shadow-2xl transition-transform transform hover:-translate-y-1 h-full">
                        <a href="{{ route('books.show', $book->id) }}" class="block">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $book->title }}</h3>
                        </a>
                        <p class="text-sm text-gray-600 mb-2">
                            <strong>Penulis:</strong> {{ $book->author }}
                        </p>
                        <p class="text-sm text-gray-600 mb-2">
                            <strong>Tahun:</strong> {{ $book->year }}
                        </p>
                        <p class="text-sm text-gray-600 mb-2">
                            <strong>ISBN:</strong> {{ $book->isbn }}
                        </p>
                        <p class="text-sm text-gray-600 mb-3">
                            <strong>Salinan:</strong> {{ $book->copies }}
                        </p>

                        <!-- Tombol Edit dan Hapus -->
                        @if (Auth::user()->role === 'admin')
                            <div class="flex justify-end space-x-4 mt-auto">
                                <a href="{{ route('books.edit', $book->id) }}"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                    Edit
                                </a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="col-span-3 text-gray-500 text-center">Buku tidak ditemukan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
