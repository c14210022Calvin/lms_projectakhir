<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <h1 class="text-center text-3xl font-bold">Borrow a Book</h1>
    
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Form -->
    <form class="o-4 border w-3/4 mx-auto flex flex-col items-center justify-center space-y-10" method="POST" action="{{ route('loan.store') }}">
        @csrf

        <div class="flex space-x-10">
            <!-- Dropdown for Book Selection -->
            <x-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded">Select a Book</button>
                </x-slot>
                <x-slot name="content">
                    <ul>
                        @foreach ($books as $book)
                            <li>
                                <label>
                                    <input type="radio" name="book_id" value="{{ $book->id }}" required>
                                    {{ $book->title }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </x-slot>
            </x-dropdown>

            <!-- Dropdown for Members -->
            <label for="member_id">Select a Member:</label>
            <select id="member_id" name="member_id" required>
                <option value="" disabled selected>-- Select a Member --</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
            <br><br>
        </div>
        

        <button  type="submit"  class="p-3 bg-blue-500 text-white rounded-md">Borrow Book</button>
    </div>

</x-app-layout>