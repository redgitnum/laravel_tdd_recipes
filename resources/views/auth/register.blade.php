{{-- <x-layout>
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
</x-layout> --}}

<x-layout>
    
    <div class="w-full max-w-sm m-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="px-6 py-4">
            <h3 class="mt-1 text-xl font-medium text-center text-gray-600 dark:text-gray-200">Create New Account</h3>

            <p class="mt-1 text-center text-gray-500 dark:text-gray-400">Provide required details to register</p>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" 
                    type="text" name="username" value="{{ old('username') }}" required placeholder="Username" aria-label="Username">
                </div>
                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" 
                    type="email" name="email" value="{{ old('email') }}" required placeholder="Email Address" aria-label="Email Address">
                </div>
                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" 
                    type="password" name="password" placeholder="Password" required aria-label="Password">
                </div>

                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" 
                    type="password" name="password_confirmation" required placeholder="Password Confirmation" aria-label="Password Confirmation">
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button class="px-4 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded hover:bg-gray-600 focus:outline-none">
                        Register
                    </button>
                </div>
            </form>
        </div>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="w-full text-white bg-red-500">
                    <div class="container flex items-center justify-between px-6 py-2 mx-auto">
                        <div class="flex">
                            <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"></path>
                            </svg>
                            <p class="mx-3">{{ $error }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif  
        <div class="flex items-center justify-center py-4 text-center bg-gray-100 dark:bg-gray-700">
            <span class="text-sm text-gray-600 dark:text-gray-200">Already have an account? </span>
            <a href="{{ route('login') }}" class="mx-2 text-sm font-bold text-blue-600 dark:text-blue-400 hover:text-blue-500">Login</a>
        </div>
    </div>
</x-layout>