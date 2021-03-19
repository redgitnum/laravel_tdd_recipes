<div class="flex justify-between py-2 text-lg px-6 bg-gray-200">
    <ul class="flex gap-4">
        <li>
            <a href="{{ route('home') }}" class="hover:text-gray-500">
                Home
            </a>
        </li>
        @auth
        <li>
            <a href="{{ route('dashboard.recipes.create') }}" class="hover:text-gray-500">
                Create Recipe
            </a>
        </li>
        @endauth
    </ul>
    <ul class="flex gap-4">
        @auth
        <li>
            <a href="{{ route('dashboard.recipes.index') }}" class="hover:text-gray-500">
                Dashboard
            </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="hover:text-gray-500">
                Logout
            </button>
        </form>
        </li>
        @endauth
        @guest
        <li>
            <a href="{{ route('login') }}" class="hover:text-gray-500">
                Login
            </a>
            </li>
            <li>
            <a href="{{ route('register') }}" class="hover:text-gray-500">
                Register
            </a>
        </li>
        @endguest
    </ul>
</div>