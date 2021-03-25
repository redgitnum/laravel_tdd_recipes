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
    <nav class="w-full md:w-4/6 mt-5 mx-auto">
        <div class="container px-6 py-3 mx-auto md:flex md:justify-between md:items-center">
            <div class="flex items-center">
                <div class="text-sm md:text-md font-bold">
                    <a href="{{ route('home') }}" class="text-blue-500 hover:text-blue-400 mr-2">Home</a>
                    &#x276F;
                    <a href="{{ route('recipe.index') }}" class="text-blue-500 font-medium hover:text-blue-400 ml-2">Recipes</a>
                </div>
            </div>
        <div>
    </nav>

    <div class="w-full md:w-4/6 px-8 py-4 mx-auto mt-5 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex items-center justify-start">
            <span class="text-sm font-light text-gray-600 dark:text-gray-400">{{ $recipe->created_at->toFormattedDateString() }}</span>
        </div>

        <div class="mt-2 mb-4">
            <div>
                <a href="#" 
                class="text-2xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline">
                {{ $recipe->title }}</a>
                by
                <a href="#" class="font-bold text-blue-500 cursor-pointer">{{ $recipe->author->username }}</a>
            </div>
            <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $recipe->overview }}</p>
        </div>
        <div class="border-t border-gray-400 mt-4">
            <p class="mt-2 text-gray-600 text-lg">Ingredients</p>
            <div class="grid gap-2 mt-2 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($recipe->ingredients as $ingredient)
                <div class="flex items-center space-x-2 text-gray-800 dark:text-gray-200">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                        <path stroke-width="0.8" d="M8.627,7.885C8.499,8.388,7.873,8.101,8.13,8.177L4.12,7.143c-0.218-0.057-0.351-0.28-0.293-0.498c0.057-0.218,0.279-0.351,0.497-0.294l4.011,1.037C8.552,7.444,8.685,7.667,8.627,7.885 M8.334,10.123L4.323,9.086C4.105,9.031,3.883,9.162,3.826,9.38C3.769,9.598,3.901,9.82,4.12,9.877l4.01,1.037c-0.262-0.062,0.373,0.192,0.497-0.294C8.685,10.401,8.552,10.18,8.334,10.123 M7.131,12.507L4.323,11.78c-0.218-0.057-0.44,0.076-0.497,0.295c-0.057,0.218,0.075,0.439,0.293,0.495l2.809,0.726c-0.265-0.062,0.37,0.193,0.495-0.293C7.48,12.784,7.35,12.562,7.131,12.507M18.159,3.677v10.701c0,0.186-0.126,0.348-0.306,0.393l-7.755,1.948c-0.07,0.016-0.134,0.016-0.204,0l-7.748-1.948c-0.179-0.045-0.306-0.207-0.306-0.393V3.677c0-0.267,0.249-0.461,0.509-0.396l7.646,1.921l7.654-1.921C17.91,3.216,18.159,3.41,18.159,3.677 M9.589,5.939L2.656,4.203v9.857l6.933,1.737V5.939z M17.344,4.203l-6.939,1.736v9.859l6.939-1.737V4.203z M16.168,6.645c-0.058-0.218-0.279-0.351-0.498-0.294l-4.011,1.037c-0.218,0.057-0.351,0.28-0.293,0.498c0.128,0.503,0.755,0.216,0.498,0.292l4.009-1.034C16.092,7.085,16.225,6.863,16.168,6.645 M16.168,9.38c-0.058-0.218-0.279-0.349-0.498-0.294l-4.011,1.036c-0.218,0.057-0.351,0.279-0.293,0.498c0.124,0.486,0.759,0.232,0.498,0.294l4.009-1.037C16.092,9.82,16.225,9.598,16.168,9.38 M14.963,12.385c-0.055-0.219-0.276-0.35-0.495-0.294l-2.809,0.726c-0.218,0.056-0.351,0.279-0.293,0.496c0.127,0.506,0.755,0.218,0.498,0.293l2.807-0.723C14.89,12.825,15.021,12.603,14.963,12.385"></path>
                    </svg>
                    <span>{{ $ingredient }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="w-full md:w-4/6 px-8 py-4 mx-auto mt-5 bg-white rounded-lg shadow-md">
        <p class="mt-2 text-gray-600 text-2xl">Steps</p>
        <div class="lg:py-6 lg:pr-16">
            @foreach ($recipe->paragraphs as $paragraph)
            <div class="flex">
              <div class="flex flex-col items-center mr-4">
                <div>
                  <div class="flex items-center justify-center w-10 h-10 border rounded-full">
                    <svg class="w-4 text-gray-600" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                      <line fill="none" stroke-miterlimit="10" x1="12" y1="2" x2="12" y2="22"></line>
                      <polyline fill="none" stroke-miterlimit="10" points="19,15 12,22 5,15"></polyline>
                    </svg>
                  </div>
                </div>
                <div class="w-px h-full bg-gray-300"></div>
              </div>
              <div class="pt-1 pb-8">
                <p class="mb-2 text-lg font-bold">Step {{ $loop->iteration }}</p>
                <p class="text-gray-700">
                  {{ $paragraph }}
                </p>
              </div>
            </div>
            @endforeach
            <div class="flex">
              <div class="flex flex-col items-center mr-4">
                <div>
                  <div class="flex items-center justify-center w-10 h-10 border rounded-full">
                    <svg class="w-6 text-gray-600" stroke="currentColor" viewBox="0 0 24 24">
                      <polyline fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6,12 10,16 18,8"></polyline>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="pt-1">
                <p class="mb-2 text-lg font-bold">Done</p>
                <p class="text-gray-700"></p>
              </div>
            </div>
          </div>
    </div>
</x-layout>