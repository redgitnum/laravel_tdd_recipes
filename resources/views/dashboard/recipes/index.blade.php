user recipes view
@admin(auth()->user())
Admin Panel
@endadmin
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