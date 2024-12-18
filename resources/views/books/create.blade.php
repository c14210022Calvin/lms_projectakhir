<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <!-- Judul -->
            <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">
                Tambah Buku Baru
            </h2>

            <!-- Form -->
            <form method="POST" action="{{ route('books.store') }}"
                class="bg-white p-8 rounded-lg shadow-lg">
                @csrf

                <!-- Input Judul Buku -->
                <div class="mb-6">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Judul Buku</label>
                    <input type="text" name="title" id="title" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition" />
                </div>

                <!-- Input Penulis -->
                <div class="mb-6">
                    <label for="author" class="block text-gray-700 font-medium mb-2">Penulis</label>
                    <input type="text" name="author" id="author" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition" />
                </div>

                <!-- Input Tahun Terbit -->
                <div class="mb-6">
                    <label for="year" class="block text-gray-700 font-medium mb-2">Tahun Terbit</label>
                    <input type="number" name="year" id="year" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition" />
                </div>

                <!-- Input ISBN -->
                <div class="mb-6">
                    <label for="isbn" class="block text-gray-700 font-medium mb-2">ISBN</label>
                    <input type="text" name="isbn" id="isbn" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition" />
                </div>

                <!-- Input Jumlah Salinan -->
                <div class="mb-6">
                    <label for="copies" class="block text-gray-700 font-medium mb-2">Jumlah Salinan</label>
                    <input type="number" name="copies" id="copies" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition" />
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-5 py-3 bg-indigo-500 text-white font-medium rounded-lg shadow-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition ease-in-out duration-300">
                        Simpan Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
