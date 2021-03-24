<x-layout>
    @if($errors->any())
    @foreach($errors->all() as $error)
    <div class="w-full text-white bg-red-500">
        <div class="container flex items-center justify-between px-6 py-1 mx-auto">
            <div class="flex">
                <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                    <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"></path>
                </svg>
                <p class="mx-3">{{ $error }}</p>
            </div>
        </div>
    </div>
    @endforeach
    @endif 
    <section class="w-full md:w-4/6 p-6 mt-5 m-auto bg-white rounded-md shadow-md dark:bg-gray-800">
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Create New Recipe</h2>
        
        <form action="{{ route('dashboard.recipes.store') }}" method="POST">
        @csrf
            <div id="inputs" class="grid grid-cols-1 gap-2 mt-4">
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="title">Title</label>
                    <input name="title" type="text" @isset($wanted) readonly @endisset value="@isset($wanted){{ $wanted->title }}@else{{ old('title') }}@endisset" required minlength="10" maxlength="50"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @isset($wanted)
                        <input type="hidden" name="request_id" value="{{ $wanted->id }}">
                    @endisset
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="overview">
                        Overview
                        <p class="text-xs text-gray-400 flex">
                            Short overview visible while looking at all recipes list
                        </p>
                    </label>
                    <textarea required name="overview" minlength="30" maxlength="150" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">{{ old('overview') }}</textarea>
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="ingredients">
                        Ingredients
                        <p class="text-xs text-gray-400 flex">
                            Comma separated list of ingredients e.g.&nbsp;<span class="text-blue-400">flour, eggs, milk</span>
                        </p>
                    </label>
                    <input name="ingredients" type="text" value="{{ old('ingredients') }}" required minlength="3"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div id="paragraph_1">
                    <label class="text-gray-700 dark:text-gray-200" for="paragraph_1">
                        Paragraph 1
                        <p class="text-xs text-gray-400 flex">
                            Each paragraph is limited to 2000 characters, add more paragraph if needed
                        </p>
                    </label>
                    <textarea name="paragraph_1" minlength="50" maxlength="2000" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">{{ old('paragraph_1') }}</textarea>
                </div>
            </div>
           
            <div class="flex justify-between mt-6">
                <div class="flex gap-4">
                    <button onclick="addParagraph()" type="button" class="flex items-center px-2 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-green-600 rounded-md dark:bg-gray-800 hover:bg-green-500 dark:hover:bg-gray-700 focus:outline-none focus:bg-green-500 dark:focus:bg-gray-700">
                        <svg class="w-5 h-5 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                        </svg>
                        <span class="mx-1">Add Paragraph</span>
                    </button>
                    <button onclick="removeParagraph()" type="button" class="flex items-center px-2 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-600 rounded-md dark:bg-gray-800 hover:bg-red-500 dark:hover:bg-gray-700 focus:outline-none focus:bg-red-500 dark:focus:bg-gray-700">
                        <svg class="w-5 h-5 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                        </svg>
                        <span class="mx-1">Remove Paragraph</span>
                    </button>
                </div>
                
                <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Submit Recipe</button>
            </div>
        </form>
    </section>
</x-layout>

<script>
    function addParagraph() {
        let pCount = +document.getElementById('inputs').lastElementChild.id.substr(-1)
        if(pCount<6){
            let newPCount = pCount+1;
            let newParagraphParent = document.createElement('div');
            let newParagraphLabel = document.createElement('label');
            let newParagraphTextarea = document.createElement('textarea');

            newParagraphParent.id = `paragraph_${newPCount}`;

            newParagraphLabel.className = 'text-gray-700 dark:text-gray-200';
            newParagraphLabel.htmlFor = `paragraph_${newPCount}`;
            newParagraphLabel.innerText = `Paragraph ${newPCount}`

            newParagraphTextarea.innerText = `{{ old('paragraph_${newPCount}') }}`;
            newParagraphTextarea.name = `paragraph_${newPCount}`;
            newParagraphTextarea.className = 'block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring';
            newParagraphTextarea.required = true;
            newParagraphTextarea.minLength = 50;
            newParagraphTextarea.maxLength = 2000;

            newParagraphParent.appendChild(newParagraphLabel);
            newParagraphParent.appendChild(newParagraphTextarea);
            document.getElementById('inputs').appendChild(newParagraphParent);
        }
    }

    function removeParagraph() {
        let pCount = +document.getElementById('inputs').lastElementChild.id.substr(-1);
        if(pCount>1){
            document.getElementById('inputs').removeChild(document.getElementById('inputs').lastElementChild);
        }
    }
</script>