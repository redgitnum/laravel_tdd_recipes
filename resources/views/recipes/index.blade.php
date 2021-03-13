@if($errors->any())
    @foreach($errors->all() as $error)
    <div>
        {{ $error }}
    </div>
@endforeach
@endif
<ul>
    @forelse($recipes as $recipe)
        <li>
            {{ $recipe->title }}    
        </li>    
    @empty
        nothing here
    @endforelse
</ul>