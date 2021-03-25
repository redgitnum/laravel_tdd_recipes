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
    
    <nav class="bg-white shadow dark:bg-gray-800 w-full md:w-4/6 mt-5 mx-auto">
        <div class="container px-6 py-3 mx-auto md:flex md:justify-between md:items-center">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xl font-bold text-gray-800 dark:text-white md:text-2xl hover:text-gray-700 dark:hover:text-gray-300">Recipes</div>
                </div>
            </div>
        <div>
    </nav>
    
    <div class="w-full md:w-4/6 mt-5 mx-auto flex items-center">
        <a href="{{ route('recipe.index') }}" class="w-full text-center border-l border-t border-b text-base font-medium rounded-l-md text-white bg-blue-400 hover:bg-blue-300 px-4 py-2">
            All Recipes
        </a>
        <a href="{{ route('recipe.wanted') }}" class="w-full text-center border-t border-b border-r text-base font-medium rounded-r-md text-black bg-white hover:bg-gray-100 px-4 py-2">
            Wanted Recipes
        </a>
    </div>

    @forelse($recipes as $recipe)
    <div class="w-full md:w-4/6 px-8 py-4 mx-auto mt-5 bg-white rounded-lg shadow-md dark:bg-gray-800">
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
            {{ $recipes->links() }}
        </div>
    </div>
</x-layout>