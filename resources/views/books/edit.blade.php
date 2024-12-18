<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">Edit Buku</h2>

            <form method="POST" action="{{ route('books.update', $book->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Buku</label>
                    <input type="text" name="title" id="title" value="{{ $book->title }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="author" class="block text-sm font-medium text-gray-700">Penulis</label>
                    <input type="text" name="author" id="author" value="{{ $book->author }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="year" class="block text-sm font-medium text-gray-700">Tahun</label>
                    <input type="number" name="year" id="year" value="{{ $book->year }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                    <input type="text" name="isbn" id="isbn" value="{{ $book->isbn }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="copies" class="block text-sm font-medium text-gray-700">Jumlah Salinan</label>
                    <input type="number" name="copies" id="copies" value="{{ $book->copies }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('books.index') }}"
                        class="ml-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
