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
    @if(session()->has('success'))
        <div class="w-full text-white bg-green-500" id="success_popup">
            <div class="container flex items-center justify-between px-6 py-4 mx-auto">
                <div class="flex">
                    <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"></path>
                    </svg>
                    <p class="mx-3">{{ session('success') }}</p>
                </div>
            </div>
        </div>
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
        <a href="{{ route('recipe.index') }}" class="w-full text-center border-l border-t border-b text-base font-medium rounded-l-md text-black bg-white hover:bg-gray-100 px-4 py-2">
            All Recipes
        </a>
        <a href="{{ route('recipe.wanted') }}" class="w-full text-center border-t border-b border-r text-base font-medium rounded-r-md text-white bg-blue-400 hover:bg-blue-300 px-4 py-2">
            Wanted Recipes
        </a>
    </div>
    <div class="container flex flex-col mx-auto mt-5 w-full items-center justify-center">
        <ul class="flex flex-col w-full md:w-4/6 overflow-hidden">
        @forelse($recipes as $recipe)
            <li class="border-gray-400 flex flex-row mb-2">
                <div class="shadow border border-r-0 select-none cursor-pointer bg-white dark:bg-gray-800 rounded-l-md flex flex-1 items-center p-4">
                    <div class="flex-1 pl-1 md:mr-16">
                        <div class="font-medium dark:text-white">
                            {{ $recipe->title }}
                        </div>
                        <div class="text-gray-600 dark:text-gray-200 text-sm">
                            @if($recipe->author)
                                {{ $recipe->author->username }}
                            @endif
                        </div>
                    </div>
                    <div class="text-gray-600 dark:text-gray-200 text-xs">
                        {{ $recipe->created_at->toFormattedDateString() }}
                    </div>
                </div>
                <a href="{{ route('dashboard.recipes.create', ['request_id' => $recipe->id]) }}" class="shadow border border-l-0 select-none cursor-pointer bg-green-400 text-white hover:bg-green-500 transition dark:bg-gray-800 rounded-r-md p-4 flex items-center">
                    Make
                </a>
            </li>
        @empty
        <div class="max-w-5xl px-8 py-4 mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="mt-2">
                <a href="#" class="text-2xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline">Nothing here :(</a>
            </div>
        </div>
        @endforelse
        </ul>
    </div>
    <div class="flex justify-center mt-6 pb-12">
        <div class="w-3/5">
            {{ $recipes->links() }}
        </div>
    </div>
</x-layout>
<script>
    if(document.getElementById('success_popup')){
        window.setTimeout(() => {
            document.getElementById('success_popup').remove();
        }, 4000);
    }
</script>