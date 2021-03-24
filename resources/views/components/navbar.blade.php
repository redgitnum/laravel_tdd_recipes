<nav class="bg-white shadow dark:bg-gray-800">
    <div class="container px-6 py-3 mx-auto md:flex md:justify-between md:items-center">
        <div class="flex items-center justify-between">
            <div>
                <a class="text-xl font-bold text-gray-800 dark:text-white md:text-2xl hover:text-gray-700 dark:hover:text-gray-300" href="{{ route('home') }}">Home</a>
            </div>
            
            <!-- Mobile menu button -->
            <div class="flex md:hidden">
                <button type="button" onclick="toggleMenu()" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400" aria-label="toggle menu">
                    <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                        <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <div class="items-center md:flex hidden" id="mobile_menu">
            <div class="flex flex-col md:flex-row md:mx-6 mt-2 gap-2">
                <a class="my-1 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-indigo-500 dark:hover:text-indigo-400 md:mx-4 md:my-0" href="{{ route('recipe.index') }}">Recipes</a>
                <a class="my-1 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-indigo-500 dark:hover:text-indigo-400 md:mx-4 md:my-0" href="{{ route('recipe.request') }}">Request Recipe</a>

                @guest
                <a class="my-1 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-indigo-500 dark:hover:text-indigo-400 md:mx-4 md:my-0" href="{{ route('login') }}">Login</a>
                <a class="my-1 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-indigo-500 dark:hover:text-indigo-400 md:mx-4 md:my-0" href="{{ route('register') }}">Register</a>
                @endguest
                @auth
                <a class="my-1 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-indigo-500 dark:hover:text-indigo-400 md:mx-4 md:my-0" href="{{ route('dashboard.recipes.create') }}">Create Recipe</a>
                <a class="my-1 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-indigo-500 dark:hover:text-indigo-400 md:mx-4 md:my-0" 
                href="{{ route('dashboard.recipes.index') }}">@admin(auth()->user()){{ 'Admin Panel' }}@else{{ 'Dashboard' }}@endadmin</a>
                <form action="{{ route('logout') }}" method="POST" class="leading-none">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class=" my-1 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-indigo-500 dark:hover:text-indigo-400 md:mx-4 md:my-0" >Logout</a>
                </form>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleMenu() {
        document.getElementById('mobile_menu').classList.toggle('hidden');
    }
</script>