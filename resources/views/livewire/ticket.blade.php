<div>
    <form wire:submit.prevent="store" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Title
            </label>
            <input wire:model="title"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="name" type="text" placeholder="Text input">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Target Date
            </label>
            <input wire:model="targetDate"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="target_date" type="date">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Urgency
            </label>
            <select wire:model="urgencyLevel" name="urgencyLevel" id="urgencyLevel"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="lowest" @if($urgencyLevel == 'lowest') selected @endif>Lowest</option>
                <option value="low" @if($urgencyLevel == 'low') selected @endif>Low</option>
                <option value="medium" @if($urgencyLevel == 'medium') selected @endif>Medium</option>
                <option value="high" @if($urgencyLevel == 'high') selected @endif>high</option>
                <option value="urgent" @if($urgencyLevel == 'urgent') selected @endif>Urgent</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryId">
                Category
            </label>
            <select wire:model="categoryId" name="category" id="category"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">--- Select ---</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            @if($categoryId == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="subcategory">
                Subcategory
            </label>
            <select wire:model="subCategoryId" name="category" id="category"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">--- Select ---</option>
                @foreach($categories as $category)
                    @foreach($category->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}"
                                @if($subCategoryId == $subcategory->id) selected @endif>{{ $subcategory->name }}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Description
                <textarea wire:model="description" name="description"
                          class="shadow form-textarea mt-1 block w-full border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                          rows="5" placeholder="Textarea"></textarea>
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryId">
                Assign To
            </label>
            <select wire:model="assignedToId" name="assignedToId" id="assignedToId"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">--- Select ---</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                            @if($user->id == $assignedToId) selected @endif>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold" for="categoryId">
                Watch Users
            </label>
            @foreach($users as $user)
                @if($user->id !== $assignedToId)
                    <input type="checkbox" value="{{ $user->id }}" class="mt-2"
                           wire:click="addWatchUsers({{ $user->id }})"
                           @if(in_array($user->id, $watchUserIds)) checked @endif
                    >
                    {{ $user->name }}<br>
                @endif
            @endforeach
        </div>
        @if($updateMode)
            <div class="flex items-center justify-between">
                <button wire:click.prevent="update"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button">
                    Update
                </button>
            </div>
        @else
            <div class="flex items-center justify-between">
                <button wire:click.prevent="submitForm"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button">
                    Submit
                </button>
            </div>
        @endif
    </form>

    @if (session()->has('message'))
        <div class="px-8 py-8">
            <h1 class="text-1xl flex justify-center cursive mb-8 bg-green-100 h-15">{{ session('message') }}</h1>
        </div>
    @endif

    <body class="antialiased sans-serif bg-gray-200">
    <div class="container mx-auto py-6 px-4">
        <h1 class="text-3xl py-4 border-b mb-10">Tickets</h1>

        <div class="mb-4 flex justify-between items-center">
            <div class="flex-1 pr-4">
                <div class="relative md:w-1/3">
                    <input type="search"
                           class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                           placeholder="Search...">
                    <div class="absolute top-0 left-0 inline-flex items-center p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <circle cx="10" cy="10" r="7"/>
                            <line x1="21" y1="21" x2="15" y2="15"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg shadow overflow-y-auto relative"
             style="height: 405px;">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                <tr class="text-left">
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-800">
                        <label
                            class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                            <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline">
                        </label>
                    </th>
                    <div>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            Title
                        </th>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            Date
                        </th>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            Urgency
                        </th>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            Category
                        </th>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            Subcategory
                        </th>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            Description
                        </th>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            Created By
                        </th>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            Assigned To
                        </th>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            Watchers
                        </th>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">

                        </th>
                    </div>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tbody>
                    <tr>
                        <td class="border-dashed border-t border-gray-200 px-3">
                            <label
                                class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                <input type="checkbox"
                                       class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline">
                            </label>
                        </td>
                        <td class="border-dashed border-t border-gray-200 userId">
                            <p class="text-gray-700 px-6 py-3 flex items-center">{{ substr($ticket->title, 0, 7) }}</p>
                        </td>
                        <td class="border-dashed border-t border-gray-200 firstName">
                        <span
                            class="text-gray-700 px-6 py-3 flex items-center">{{ $ticket->target_date->diffForHumans() }}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 lastName">
                            <span class="text-gray-700 px-6 py-3 flex items-center">{{ $ticket->urgency_level }}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 emailAddress">
                            <span class="text-gray-700 px-6 py-3 flex items-center">{{ $ticket->category->name }}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 gender">
								<span class="text-gray-700 px-6 py-3 flex items-center"
                                >{{ $ticket->subcategory->name }}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 phoneNumber">
								<span class="text-gray-700 px-6 py-3 flex items-center"
                                >{{ substr($ticket->description, 0, 30) }}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 phoneNumber">
								<span class="text-gray-700 px-6 py-3 flex items-center"
                                >{{ $ticket->author->name }}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 gender">
                            @if (count($ticket->invlolvedTeamMembers))
                                @foreach($ticket->invlolvedTeamMembers as $member)
                                    @if($member->assigned == 1)
                                        <span class="text-gray-700 px-6 py-3 flex items-center"
                                        >{{ $member->name }}</span>
                                    @endif
                                @endforeach
                            @else
                                <span class="text-gray-700 px-6 py-3 flex items-center"
                                >/</span>
                            @endif
                        </td>
                        <td class="border-dashed border-t border-gray-200 gender">
                        <span class="text-gray-700 px-6 py-3 flex items-center">
                            @if (count($ticket->invlolvedTeamMembers))
                                @foreach($ticket->invlolvedTeamMembers as $member)
                                    @if($member->watcher == 1)
                                        <span
                                            class="text-gray-700 px-6 py-3 flex items-center">{{ $member->name }}</span>
                                    @endif
                                @endforeach
                            @else
                                <span class="text-gray-700 px-6 py-3 flex items-center">/</span>
                            @endif
                        </span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 gender">
                        <span class="text-gray-700 px-6 py-3 flex items-center">
                            <button wire:click="edit({{ $ticket->id }})">✅</button>
{{--                        </span>--}}
                            {{--                        <span class="text-gray-700 px-6 py-3 flex items-center">--}}
                            <button wire:click="edit({{ $ticket->id }})">Edit</button>
{{--                        </span>--}}
                            {{--                        <span class="text-gray-700 px-6 py-3 flex items-center">--}}
                            <button wire:click="delete({{ $ticket->id }})">❌</button>
                        </span>
                        </td>
                    </tr>
                    </tbody>
                    @endforeach

                    </tbody>
            </table>
        </div>
        <div class="mr-4 ml-4 mb-4 mt-0">
            {{ $tickets->links() }}
        </div>
    </div>


    </body>
</div>



<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab:400,700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        width: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Roboto', sans-serif;
        padding: 3rem 0;
    }

    form {
        width: 100%;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        width: 100%
    }

    .u-slab {
        font-family: 'Roboto Slab', serif;
    }


    .tick {
        list-style-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='none' stroke='rgb(102, 126, 234)' class='text-indigo-700' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ctitle id='catTitle'%3ERelevant package title ( too many to add )%3C/title%3E%3Cpath d='M20 6L9 17l-5-5'/%3E%3C/svg%3E");

    }
</style>
