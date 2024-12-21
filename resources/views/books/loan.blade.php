<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-center text-3xl font-bold mb-6 text-gray-800">Borrow a Book</h1>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('loan.store') }}" class="space-y-6">
                @csrf

                <!-- Book Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="book_id">Select a Book</label>
                    <select id="book_id" name="book_id"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="" disabled selected>-- Select a Book --</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Member Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="member_id">Select a Member</label>
                    <select id="member_id" name="member_id"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="" disabled selected>-- Select a Member --</option>
                        @foreach ($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Borrow Book
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
