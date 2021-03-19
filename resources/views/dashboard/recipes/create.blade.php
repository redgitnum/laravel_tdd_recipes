<x-layout>
    @admin(auth()->user())
    Admin Panel
    @endadmin
    @if($errors->any())
        @foreach($errors->all() as $error)
        <div>
            {{ $error }}
        </div>
        @endforeach
    @endif
    <div class="h-full flex flex-col justify-center items-center">
        <form action="{{ route('dashboard.recipes.store') }}" method="POST" class="text-white w-3/5">
            @csrf
            <div class="bg-red-500 flex items-center rounded my-2 shadow">
                @if($errors->any())
                <div class="flex-1 mr-4 p-4 border-r-2 border-white border-opacity-50">
                    <span class="text-lg">Something went wrong</span>
                    <ul class="text-xs uppercase list-disc pl-6">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="text-4xl pr-4 border-black">
                    &#x26A0;
                </div>
                @endif
            </div>
            <div class="bg-blue-500 p-6 mb-2 flex flex-col items-center gap-2 rounded shadow">
                <h1 class="self-center text-2xl mb-4">Create Recipe</h1>
                <label for="title" class="w-full flex items-center">
                    <div class="text-right w-24">Title</div>
                    <input type="text" name="title" required class="ml-2 p-1 rounded text-black flex-1" @isset($wanted) disabled @endisset value="@isset($wanted) {{ $wanted->title }} @else {{ old('title') }} @endisset">
                </label>
                <label for="overview" class="w-full flex">
                    <div class="text-right w-24">Overview</div>
                    <textarea type="text" name="overview" required class="ml-2 p-1 rounded text-black flex-1 resize-none">{{ old('overview') }}</textarea>
                </label>
                <label for="ingredients" class="w-full flex">
                    <div class="text-right w-24">Ingredients</div>
                    <input type="text" name="ingredients" required class="ml-2 p-1 rounded text-black flex-1" value="{{ old('ingredients') }}">
                </label>
                <label for="paragraph_1" class="w-full flex">
                    <div class="text-right w-24">Paragraph 1</div>
                    <textarea name="paragraph_1" required class="ml-2 p-1 rounded text-black flex-1 ">{{ old('paragraph_1') }}</textarea>
                </label>
                <button type="button" id="add_paragraph_button" onclick="addParagraph(this)">Add extra Paragraph</button>
            </div>
            <button type="submit" class="w-full p-2 rounded bg-green-500 shadow hover:bg-green-600">Create Recipe</button>
        </form>
    </div>
    <script>
        function addParagraph(e) {
            let paragraphCount = +e.previousElementSibling.htmlFor.slice(-1);
            if(paragraphCount < 6){
                let newParagraph = document.createElement('label');
                let newParagraphDivText = document.createElement('div');
                let newParagraphInput = document.createElement('textarea');
                let newParagraphDeleteButton = document.createElement('button');
                let buttonTargetNode = document.getElementById('add_paragraph_button');

                newParagraph.className = 'w-full flex';
                newParagraph.setAttribute('for', `paragraph_${paragraphCount+1}`);

                newParagraphDivText.innerText = `Paragraph ${paragraphCount+1} `;
                newParagraphDivText.className = 'text-right w-24';
                
                newParagraphInput.name = `paragraph_${paragraphCount+1}`;
                newParagraphInput.className = 'ml-2 p-1 rounded text-black flex-1';
                newParagraphInput.value = `{{ old('paragraph_${paragraphCount+1}') }}`;

                newParagraphDeleteButton.type = 'button';
                newParagraphDeleteButton.className = 'bg-red-500 hover:bg-red-400 p-2 text-center rounded ml-1 text-4xl';
                newParagraphDeleteButton.innerHTML = '&#x2715;';
                newParagraphDeleteButton.onclick = function(e) { e.target.parentNode.remove() };

                newParagraph.appendChild(newParagraphDivText);
                newParagraph.appendChild(newParagraphInput);
                newParagraph.appendChild(newParagraphDeleteButton);
                buttonTargetNode.parentNode.insertBefore(newParagraph, buttonTargetNode);
            }
        }
    </script>
</x-layout>