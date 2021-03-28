<div class="h-full bg-gray-300" style="background-color: #e6f7ff">
    <div wire:poll.5500ms>
        <div class="grid grid-flow-col justify-around pb-6 pt-6 text-gray-600">
            <h1>
                {{ $projectData->name }} Board
            </h1>
        </div>

        <div class="grid grid-flow-col justify-around pb-10">
            @foreach($projectData->categories as $category)
                <div class="bg-white mt-4 pr-1 pl-1 pb-1 rounded ">
                    <div
                        class='flex w-80 bg-white shadow-md rounded-lg overflow-hidden mb-2 mt-2 border-solid border-2 border-gray-300 '>
                        <div class='flex items-center w-full px-2 py-3'>
                            <div class="text-gray-500">{{ $category->name }}</div>
                        </div>
                    </div>
                    @foreach($category->tickets as $ticket)
                        <a href="#">
                            <div
                                class='flex max-w-sm w-80 border-solid border-2 border-indigo-400 shadow-md rounded-md overflow-hidden mx-auto mb-1 bg-gradient-to-r from-green-200 to-green-500'>
                                <div class='flex items-center w-full px-2 py-3'>
                                    <div class='mx-3 w-full'>
                                        <div class="flex flex-row mb-6 mt-2">
                                            @if($ticket->urgency_level === 'low')
                                                <div class="mr-1 h-2 w-8 bg-blue-600 rounded-full cursor-pointer"></div>
                                            @elseif($ticket->urgency_level === 'medium')
                                                <div
                                                    class="mr-1 h-2 w-8 bg-yellow-600 rounded-full cursor-pointer"></div>
                                            @elseif($ticket->urgency_level === 'high')
                                                <div class="mr-1 h-2 w-8 bg-red-400 rounded-full cursor-pointer"></div>
                                            @endif
                                        </div>
                                        <div class="flex flex-row mb-4">
                                            <img class='w-14 h-14 object-cover rounded-full border-2 shadow'
                                                 alt='User avatar'
                                                 src='https://images.unsplash.com/photo-1477118476589-bff2c5c4cfbb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=200&q=200'>
                                            <div class="flex flex-col mb-4 ml-4 mt-1">
                                                <div
                                                    class='text-gray-600 font-semibold underline pb-1 text-lg text-right'>{{ $ticket->title }}</div>
                                                <div class='text-gray-600 font-base text-sm pb-1  text-right'>
                                                    email@example.com
                                                </div>
                                                <div
                                                    class='text-white font-base text-sm italic text-right'>{{ substr($ticket->description, 0, 30) }}
                                                    ...
                                                </div>
                                                <select wire:model="ticketCategory" wire:change="ticketCategoryChange">
                                                    @foreach($projectData->categories as $cat)
                                                        <option value="{{ $ticket->id . '-' . $cat->id }}"
                                                        @if($ticket->category_id === $cat->id) selected @endif>{{ $cat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .underline {
        text-decoration-color: #7f9cf5;
        text-decoration: underline;
    }
</style>
