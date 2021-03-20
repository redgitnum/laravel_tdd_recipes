

<x-layout>
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
    @forelse(auth()->user()->recipes()->paginate() as $recipe)
    <div class="w-4/6 px-8 py-4 mx-auto mt-5 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex items-center justify-start">
            <span class="text-sm font-light text-gray-600 dark:text-gray-400">{{ $recipe->created_at->toFormattedDateString() }}</span>
        </div>

        <div class="mt-2">
            <a href="{{ route('recipe.details', $recipe) }}" class="text-2xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline">{{ $recipe->title }}</a>
            <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $recipe->overview }}</p>
        </div>
        
        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('recipe.details', $recipe) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Read more</a>

            <div class="flex items-center">
                <a class="font-bold text-gray-700 cursor-pointer dark:text-gray-200">{{ $recipe->author->username }}</a>
            </div>
        </div>
    </div>
    @empty
    <div class="max-w-5xl px-8 py-4 mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="mt-2">
            <a href="#" class="text-2xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline">Nothing here :(</a>
        </div>
    </div>
    @endforelse
    <div class="flex justify-center mt-6 pb-12">
        <div class="w-3/5">
            @if(auth()->user()->recipes)
                {{ auth()->user()->recipes()->paginate()->links() }}
            @endif
        </div>
    </div>
</x-layout>