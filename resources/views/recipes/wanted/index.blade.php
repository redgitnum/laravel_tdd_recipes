<x-layout>
    @if($errors->any())
        @foreach($errors->all() as $error)
        <div>
            {{ $error }}
        </div>
    @endforeach
    @endif
    <div class="self-center w-3/5 py-4 text-lg">
        <a href="{{ route('home') }}">
            All recipes
        </a>
        <span class="px-2">/</span>
        <a href="{{ route('recipe.wanted') }}" class="underline">
            Wanted recipes
        </a>
    </div>
    <ul class="flex flex-col items-center gap-2">
    @forelse($recipes as $recipe)
        <li class="w-3/5 bg-yellow-200">
            {{-- header --}}
            <section class="flex bg-indigo-100 rounded">
                <div class="flex flex-1 justify-between">
                    <div class="flex px-2 py-4">
                        <span class="text-green-700">{{ $recipe->title }}</span>&nbsp;requested by&nbsp;<b> {{ $recipe->author->username }}</b>
                    </div>
                    <div class="flex items-center">
                        <div>
                            {{ $recipe->created_at->diffForHumans() }}
                        </div>
                        <a href="{{ route('dashboard.recipes.create', ['request_id' => $recipe->id]) }}" 
                            class="bg-green-300 px-4 ml-2 h-full hover:bg-green-200 flex items-center">
                            Accept request
                        </a>
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