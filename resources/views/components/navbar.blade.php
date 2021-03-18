<div class="flex justify-between py-2 text-lg px-6 bg-gray-200">
    <ul>
        <li>
            <a href="{{ route('home') }}">
                Home
            </a>
        </li>
    </ul>
    <ul class="flex gap-2">
        @auth
        <li>
            <a href="{{ route('dashboard.recipes.index') }}">
                Dashboard
            </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
            @csrf
            @method('DELETE')
            <button>
                Logout
            </button>
        </form>
        </li>
        @endauth
        @guest
        <li>
            <a href="{{ route('login') }}">
                Login
            </a>
            </li>
            <li>
            <a href="{{ route('register') }}">
                Register
            </a>
        </li>
        @endguest
    </ul>
</div>