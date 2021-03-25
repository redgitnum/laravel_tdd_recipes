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
                    <div class="text-xl font-bold text-gray-800 dark:text-white md:text-2xl hover:text-gray-700 dark:hover:text-gray-300">
                        @admin(auth()->user())
                        Admin Panel
                        @else
                        Dashboard
                        @endadmin
                    </div>
                    @admin(auth()->user())
                    @else
                    <div class="text-sm text-gray-600">Your Recipes</div>
                    @endadmin
                </div>
            </div>
        <div>
    </nav>

    @forelse($recipes as $recipe)
    <div class="w-4/6 px-8 py-4 mx-auto mt-5 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex items-center justify-between">
            <div class="text-sm font-light text-gray-600 dark:text-gray-400">{{ $recipe->created_at->toFormattedDateString() }}</div>
            <div class="flex gap-2">
                <a href="{{ route('dashboard.recipes.edit', $recipe) }}" class="flex items-center px-2 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-gray-700 focus:outline-none focus:bg-blue-500 dark:focus:bg-gray-700">
                    <svg class="w-5 h-5 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill="white" d="M19.404,6.65l-5.998-5.996c-0.292-0.292-0.765-0.292-1.056,0l-2.22,2.22l-8.311,8.313l-0.003,0.001v0.003l-0.161,0.161c-0.114,0.112-0.187,0.258-0.21,0.417l-1.059,7.051c-0.035,0.233,0.044,0.47,0.21,0.639c0.143,0.14,0.333,0.219,0.528,0.219c0.038,0,0.073-0.003,0.111-0.009l7.054-1.055c0.158-0.025,0.306-0.098,0.417-0.211l8.478-8.476l2.22-2.22C19.695,7.414,19.695,6.941,19.404,6.65z M8.341,16.656l-0.989-0.99l7.258-7.258l0.989,0.99L8.341,16.656z M2.332,15.919l0.411-2.748l4.143,4.143l-2.748,0.41L2.332,15.919z M13.554,7.351L6.296,14.61l-0.849-0.848l7.259-7.258l0.423,0.424L13.554,7.351zM10.658,4.457l0.992,0.99l-7.259,7.258L3.4,11.715L10.658,4.457z M16.656,8.342l-1.517-1.517V6.823h-0.003l-0.951-0.951l-2.471-2.471l1.164-1.164l4.942,4.94L16.656,8.342z"></path>
                    </svg>
                    <span class="mx-1">Edit</span>
                </a>
                <form action="{{ route('dashboard.recipes.destroy', $recipe) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="flex items-center px-2 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-600 rounded-md dark:bg-gray-800 hover:bg-red-500 dark:hover:bg-gray-700 focus:outline-none focus:bg-red-500 dark:focus:bg-gray-700">
                        <svg class="w-5 h-5 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill="white" d="M18.693,3.338h-1.35l0.323-1.834c0.046-0.262-0.027-0.536-0.198-0.739c-0.173-0.206-0.428-0.325-0.695-0.325
							H3.434c-0.262,0-0.513,0.114-0.685,0.312c-0.173,0.197-0.25,0.46-0.215,0.721L2.79,3.338H1.307c-0.502,0-0.908,0.406-0.908,0.908
							c0,0.502,0.406,0.908,0.908,0.908h1.683l1.721,13.613c0.057,0.454,0.444,0.795,0.901,0.795h8.722c0.458,0,0.845-0.34,0.902-0.795
							l1.72-13.613h1.737c0.502,0,0.908-0.406,0.908-0.908C19.601,3.744,19.195,3.338,18.693,3.338z M15.69,2.255L15.5,3.334H4.623
							L4.476,2.255H15.69z M13.535,17.745H6.413L4.826,5.193H15.12L13.535,17.745z"></path>
                        </svg>
                        <span class="mx-1">Delete</span>
                    </button>
                </form>
            </div>
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
            @if($recipes)
                {{ $recipes->links() }}
            @endif
        </div>
    </div>
</x-layout>