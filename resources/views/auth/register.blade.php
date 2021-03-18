<x-layout>
    <div class="h-full flex flex-col justify-center items-center">
        <form action="{{ route('register') }}" method="POST" class=" text-white">
            @csrf
            <div class="bg-red-500 flex items-center rounded my-2 shadow">
                @if($errors->any())
                <div class="flex-1 mr-4 p-4 border-r-2 border-white border-opacity-50">
                    <span class="text-lg">Something went wrong</span>
                    <ul class="text-xs uppercase list-disc pl-6">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="text-4xl pr-4 border-black">
                    &#x26A0;
                </div>
                @endif
            </div>
            <div class="bg-blue-500 p-6 mb-2 flex flex-col items-end gap-2 rounded shadow">
                <h1 class="self-center text-2xl mb-4">Register</h1>
                <label for="username">Username
                    <input type="username" name="username" required class="ml-2 p-1 rounded text-black" value="{{ old('username') }}">
                </label>
                <label for="email">Email
                    <input type="email" name="email" required class="ml-2 p-1 rounded text-black" value="{{ old('email') }}">
                </label>
                <label for="password">Password
                    <input type="password" name="password" min="5" required class="ml-2 p-1 rounded text-black">
                </label>
                <label for="password_confirmation">Confirm Password
                    <input type="password" name="password_confirmation" min="5" required class="ml-2 p-1 rounded text-black">
                </label>
            </div>
            <button type="submit" class="w-full p-2 rounded bg-green-500 shadow hover:bg-green-600">Register</button>
            <div class="text-black py-2 text-center">
                or
                <a href="{{ route('login') }}" class="text-yellow-500 font-bold">Login</a>
            </div>
        </form>
    </div>
</x-layout>