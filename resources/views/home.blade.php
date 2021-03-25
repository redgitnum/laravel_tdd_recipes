<x-layout>
    <header class="bg-white dark:bg-gray-800 my-auto">
        <div class="md:flex">
            <div class="flex items-center justify-center w-full px-6 py-8 md:h-128 md:w-1/2">
                <div class="max-w-xl">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white md:text-3xl">Research or create Your own <span class="text-yellow-500 dark:text-indigo-400">Recipes</span></h2>
                        
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 md:text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis commodi cum cupiditate ducimus, fugit harum id necessitatibus odio quam quasi, quibusdam rem tempora voluptates.</p>

                    <div class="flex mt-6">
                        <a href="{{ route('recipe.index') }}" class="block px-3 py-2 text-xs font-semibold text-white transition-colors duration-200 transform bg-gray-900 rounded-md hover:bg-gray-700">All Recipes</a>
                        <a href="{{ route('dashboard.recipes.create') }}" class="block px-3 py-2 mx-4 text-xs font-semibold text-gray-700 transition-colors duration-200 transform bg-gray-200 rounded-md hover:bg-gray-300">Create Recipe</a>
                    </div>
                </div>
            </div>
            
            <div class="w-full h-64 md:w-1/2 md:h-auto">
                <div class="w-full h-full bg-cover" style="background-image: url(images/jimmy-dean-my1mDMraGf0-unsplash.jpg)">
                    <div class="w-full h-full bg-black opacity-25">
                    </div>
                    <div class="uppercase text-xs">
                        Photo by <a href="https://unsplash.com/@jimmydean?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Jimmy Dean</a> on <a href="/s/photos/cooking?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</x-layout>