user recipes view
<ul>
    @forelse(auth()->user()->recipes as $recipe)
        <li>
            {{ $recipe->title }}
        </li>
    @empty
        <li>
            No recipes found
        </li>
    @endforelse
</ul>