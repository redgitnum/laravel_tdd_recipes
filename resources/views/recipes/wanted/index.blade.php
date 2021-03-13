<ul>
    @forelse($recipes as $recipe)
        <li>
            {{ $recipe->title }}
        </li>
    @empty
        No recipes found
    @endforelse
</ul>