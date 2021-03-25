<x-layout>
    <div class="w-full max-w-sm m-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="px-6 py-4">
            <h3 class="mt-1 text-xl font-medium text-center text-gray-600 dark:text-gray-200">Request recipe</h3>

            <p class="mt-1 text-center text-gray-500 dark:text-gray-400">Put title of recipe you want below</p>

            <form action="{{ route('recipe.request') }}" method="POST">
                @csrf
                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" 
                    type="text" name="title" placeholder="Recipe Title" aria-label="Recipe Title" value="{{ old('title') }}" required>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <button class="px-4 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded hover:bg-gray-600 focus:outline-none">
                        Request Recipe
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
    </div>
</x-layout>