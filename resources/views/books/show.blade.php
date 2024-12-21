<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <!-- Header Buku -->
                <div class="bg-indigo-500 text-white p-6">
                    <h1 class="text-4xl font-bold mb-2">{{ $book->title }}</h1>
                    <p class="text-lg font-medium">Ditulis oleh: {{ $book->author }}</p>
                </div>

                <!-- Konten Detail Buku -->
                <div class="p-6 space-y-4">
                    <div class="flex items-center">
                        <span class="w-6 h-6 text-indigo-500 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16l-4-4m0 0l4-4m-4 4h16" />
                            </svg>
                        </span>
                        <p class="text-lg text-gray-700">
                            <strong>Tahun:</strong> {{ $book->year }}
                        </p>
                    </div>

                    <div class="flex items-center">
                        <span class="w-6 h-6 text-indigo-500 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                        <p class="text-lg text-gray-700">
                            <strong>ISBN:</strong> {{ $book->isbn }}
                        </p>
                    </div>

                    <div class="flex items-center">
                        <span class="w-6 h-6 text-indigo-500 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                        </span>
                        <p class="text-lg text-gray-700">
                            <strong>Salinan:</strong> {{ $book->copies }}
                        </p>
                    </div>

                    @if ($book->detail)
                        <div class="flex items-center">
                            <span class="w-6 h-6 text-indigo-500 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <p class="text-lg text-gray-700">
                                <strong>Genre:</strong> {{ $book->detail->genre }}
                            </p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Deskripsi:</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ $book->detail->description }}
                            </p>
                        </div>
                    @else
                        <div>
                            <p class="text-lg text-gray-600 italic">Detail tidak tersedia.</p>
                        </div>
                    @endif
                </div>

                <!-- Tombol Aksi -->
                <div class="bg-gray-100 p-4 flex justify-end space-x-4">
                    <a href="{{ route('books.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                        Kembali
                    </a>
                    @if (Auth::user()->role === 'admin')
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
