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
                    <option value="{{ $category->id }}" @if($categoryId == $category->id) selected @endif>{{ $category->name }}</option>
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
                        <option value="{{ $subcategory->id }}" @if($subCategoryId == $subcategory->id) selected @endif>{{ $subcategory->name }}</option>
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
                    <option value="{{ $user->id }}" @if($user->id == $assignedToId) selected @endif>{{ $user->name }}</option>
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

    <div class="min-h-screen p-12 bg-white">
        <div class="container mx-auto">
            <div class="grid grid-cols-11 gap-1 mb-3">
                <div>Title</div>
                <div>Date</div>
                <div>Urgency</div>
                <div>Category</div>
                <div>Subcategory</div>
                <div>Description</div>
                <div>Created By</div>
                <div>Assigned To</div>
                <div>Watchers</div>
                <div>Action</div>
            </div>
            @foreach($tickets as $ticket)
                <div class="grid grid-cols-11 gap-1 text-left">

                    <div>{{ substr($ticket->title, 0, 7)}}</div>
                    <div>{{ $ticket->target_date->diffForHumans() }}</div>
                    <div>{{ $ticket->urgency_level }}</div>
                    <div>{{ $ticket->category->name }}</div>
                    <div>{{ $ticket->subcategory->name }}</div>
                    <div>{{ $ticket->description }}</div>
                    <div>{{ $ticket->author->name }}</div>
                    <div>
                        @foreach($ticket->invlolvedTeamMembers as $member)
                            @if($member->assigned == 1)
                                {{ $member->name }}
                            @endif
                        @endforeach
                    </div>
                    <div>
                        @foreach($ticket->invlolvedTeamMembers as $member)
                            @if($member->watcher == 1)
                                {{ $member->name }}
                            @endif
                        @endforeach
                    </div>
                    <div>
                        <button wire:click="edit({{ $ticket->id }})">Edit</button>
                        <button wire:click="delete({{ $ticket->id }})">Delete</button>
                    </div>
                </div>
                <br>
            @endforeach

            {{--            <h1 class="text-3xl flex justify-center cursive mb-8">Tickets</h1>--}}
            {{--            <table class='shadow-md rounded max-w-6xl m-auto '>--}}
            {{--                <thead class='sticky block top-0' scope='col'>--}}
            {{--                <tr class='flex text-left'>--}}
            {{--                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white border-r-0 border-gray-300 font-normal'>--}}
            {{--                        <h4 class='u-slab'>Title</h4>--}}
            {{--                    </th>--}}
            {{--                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white border-r-0 border-gray-300 font-normal'>--}}
            {{--                        <h4 class='u-slab'>Date</h4>--}}
            {{--                    </th>--}}
            {{--                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white border-r-0 border-gray-300 font-normal'>--}}
            {{--                        <h4 class='u-slab'>Urgency</h4>--}}
            {{--                    </th>--}}
            {{--                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>--}}
            {{--                        <h4 class='u-slab'>Category</h4>--}}
            {{--                    </th>--}}
            {{--                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>--}}
            {{--                        <h4 class='u-slab'>Subcateg</h4>--}}
            {{--                    </th>--}}
            {{--                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>--}}
            {{--                        <h4 class='u-slab'>Description</h4>--}}
            {{--                    </th>--}}
            {{--                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>--}}
            {{--                        <h4 class='u-slab'>Created By</h4>--}}
            {{--                    </th>--}}
            {{--                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>--}}
            {{--                        <h4 class='u-slab'>Assigned To</h4>--}}
            {{--                    </th>--}}
            {{--                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>--}}
            {{--                        <h4 class='u-slab'>Watchers</h4>--}}
            {{--                    </th>--}}
            {{--                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>--}}
            {{--                        <h4 class='u-slab'>Active</h4>--}}
            {{--                    </th>--}}
            {{--                </tr>--}}
            {{--                </thead>--}}

            {{--                <tbody>--}}



            {{--                @foreach($tickets as $ticket)--}}
            {{--                    <tr class='flex text-left bg-white'>--}}
            {{--                        <th scope='col'--}}
            {{--                            class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ substr($ticket->title, 0, 7)}}</th>--}}
            {{--                        <th scope='col'--}}
            {{--                            class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ substr($ticket->target_date->diffForHumans(),0,7) }}</th>--}}
            {{--                        <th scope='col'--}}
            {{--                            class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ $ticket->urgency_level }}</th>--}}
            {{--                        <th scope='col'--}}
            {{--                            class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ substr($ticket->category->name, 0, 7)}}</th>--}}
            {{--                        <th scope='col'--}}
            {{--                            class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ substr($ticket->subcategory->name, 0, 7)}}</th>--}}
            {{--                        <th scope='col'--}}
            {{--                            class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ $ticket->description }}</th>--}}
            {{--                        <th scope='col'--}}
            {{--                            class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ substr($ticket->author->name, 0, 7)}}</th>--}}
            {{--                        <th scope='col'--}}
            {{--                            class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ substr($ticket->author->name, 0, 7)}}</th>--}}
            {{--                        <th scope='col'--}}
            {{--                            class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>--}}
            {{--                            @foreach($ticket->invlolvedTeamMembers as $member)--}}
            {{--                                @if($member->assigned == 1)--}}
            {{--                                    {{ $member->name }}--}}
            {{--                                @endif--}}
            {{--                            @endforeach--}}
            {{--                            <p>sasas</p>--}}
            {{--                        </th>--}}
            {{--                        <th scope='col'--}}
            {{--                            class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>--}}
            {{--                            @foreach($ticket->invlolvedTeamMembers as $member)--}}
            {{--                                @if($member->watcher == 1)--}}
            {{--                                    {{ $member->name }}--}}
            {{--                                @endif--}}
            {{--                            @endforeach--}}
            {{--                            <p>asdas</p>--}}
            {{--                        </th>--}}
            {{--                        <th scope='col' class='w-1/3 p-4 border border-t-0 border-gray-300 flex flex-col'>--}}
            {{--                            <button wire:click="edit({{ $ticket->id }})">Edit</button>--}}
            {{--                            <button wire:click="delete({{ $ticket->id }})">Delete</button>--}}
            {{--                        </th>--}}
            {{--                    </tr>--}}
            {{--                @endforeach--}}
            {{--                </tfoot>--}}
            {{--            </table>--}}
        </div>
    </div>
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
