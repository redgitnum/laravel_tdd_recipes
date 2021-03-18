<x-layout>
    @if($errors->any())
        @foreach($errors->all() as $error)
        <div>
            {{ $error }}
        </div>
    @endforeach
    @endif
    <div class="self-center w-3/5 py-4 text-lg">
        <a href="{{ route('home') }}" class="underline">
            All recipes
        </a>
        <span class="px-2">/</span>
        <a href="{{ route('recipe.wanted') }}">
            Wanted recipes
        </a>
    </div>
    <ul class="flex flex-col items-center gap-2">
    @forelse($recipes as $recipe)
        <li class="w-3/5 bg-yellow-200">
            {{-- header --}}
            <section class="flex bg-indigo-100 p-2 rounded">
                <img src="https://via.placeholder.com/150" alt="">
                <div class="flex-1 p-2">
                    <div class="flex justify-between">
                        <div>
                            <div>
                                {{ $recipe->title }} by {{ $recipe->author->username }}
                            </div>
                            <div class="text-xs uppercase">
                                ingredients
                            </div>
                        </div>
                        <div>
                            {{ $recipe->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-60 rounded shadow p-2 my-2">
                        {{ $recipe->overview }}
                    </div>
                </div>
            </section>
        </li>    
    @empty
    <li class="w-3/5 bg-yellow-200">
        {{-- header --}}
        <section class="flex bg-indigo-100 p-2 rounded">
            <div class="flex-1 p-2">
                <div class="text-xs uppercase">
                    Nothing here
                </div>
            </div>
        </section>
    </li>
    @endforelse
    </ul>
    <div class="flex justify-center mt-6 pb-12">
        <div class="w-3/5">
            {{ $recipes->links() }}
        </div>
    </div>
</x-layout>