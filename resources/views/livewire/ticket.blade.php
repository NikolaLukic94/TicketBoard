@if($updateMode)
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
               id="target_date" type="date" placeholder="Text input">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            Urgency
        </label>
        <select wire:model="urgencyLevel" name="urgencyLevel" id="urgencyLevel"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="lowest">Lowest</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">high</option>
            <option value="urgent">Urgent</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryId">
            Category
        </label>
        <select wire:model="categoryId" name="category" id="category"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @foreach($categories as $category)
                <option value="">--- Select ---</option>
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="subcategory">
            Subcategory
        </label>
        <select wire:model="subCategoryId" name="category" id="category"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @foreach($categories as $category)
                @foreach($category->subcategories as $subcategory)
                    <option value="">--- Select ---</option>
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
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
    <div class="flex items-center justify-between">
        <button wire:click.prevent="submitForm"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="button">
            Submit
        </button>
    </div>
@else
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
                   id="target_date" type="date" placeholder="Text input">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Urgency
            </label>
            <select wire:model="urgencyLevel" name="urgencyLevel" id="urgencyLevel"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="lowest">Lowest</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">high</option>
                <option value="urgent">Urgent</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryId">
                Category
            </label>
            <select wire:model="categoryId" name="category" id="category"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($categories as $category)
                    <option value="">--- Select ---</option>
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="subcategory">
                Subcategory
            </label>
            <select wire:model="subCategoryId" name="category" id="category"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($categories as $category)
                    @foreach($category->subcategories as $subcategory)
                        <option value="">--- Select ---</option>
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
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
            <select wire:model="categoryId" name="category" id="category"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($users as $user)
                    <option value="">--- Select ---</option>
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryId">
                Watch Users
            </label>
            <select wire:model="categoryId" name="category" id="category"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($users as $user)
                    <option value="">--- Select ---</option>
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-center justify-between">
            <button wire:click.prevent="submitForm"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="button">
                Submit
            </button>
        </div>
    </form>
@endif
@if (session()->has('message'))
    <div class="px-8 py-8">
        <h1 class="text-1xl flex justify-center cursive mb-8 bg-green-100 h-15">{{ session('message') }}</h1>
    </div>
@endif
<div class="min-h-screen p-12 bg-white">
    <div class="container mx-auto">
        <h1 class="text-3xl flex justify-center cursive mb-8">Tickets</h1>
        <table class='shadow-md rounded max-w-5xl m-auto '>
            <thead class='sticky block top-0' scope='col'>
            <tr class='flex text-left'>
                <th scope='row'
                    class=' hidden sm:block w-1/4 p-4 border bg-gray-100 border-r-0 rounded-tl border-gray-300'>
                    <h4 class='u-slab'>ID</h4>
                </th>
                <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white border-r-0 border-gray-300 font-normal'>
                    <h4 class='u-slab'>Title</h4>
                </th>
                <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white border-r-0 border-gray-300 font-normal'>
                    <h4 class='u-slab'>Target Date</h4>
                </th>
                <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white border-r-0 border-gray-300 font-normal'>
                    <h4 class='u-slab'>Urgency</h4>
                </th>
                <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>
                    <h4 class='u-slab'>Category</h4>
                </th>
                <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>
                    <h4 class='u-slab'>Subcategory</h4>
                </th>
                <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>
                    <h4 class='u-slab'>Description</h4>
                </th>
                <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>
                    <h4 class='u-slab'>Created By</h4>
                </th>
                <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>
                    <h4 class='u-slab'>Assigned To</h4>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($tickets as $ticket)
                <tr class='flex text-left bg-white'>
                    <th scope='row'
                        class='w-1/4 p-4 bg-gray-100 border border-r-0 border-t-0 border-gray-300 hidden sm:block'>{{ $ticket->id }}</th>
                    <th scope='col'
                        class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ $ticket->title }}</th>
                    <th scope='col'
                        class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ $ticket->target_date->diffForHumans() }}</th>
                    <th scope='col'
                        class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ $ticket->urgency_level }}</th>
                    <th scope='col'
                        class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ $ticket->category_id }}</th>
                    <th scope='col'
                        class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ $ticket->subcategory_id }}</th>
                    <th scope='col'
                        class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ $ticket->description }}</th>
                    <th scope='col'
                        class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ $ticket->author_id }}</th>
                    <th scope='col'
                        class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>Assigned To</th>
                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border border-t-0 border-gray-300 flex flex-col'>
                        <button wire:click="edit({{ $ticket->id }})">Edit</button>
                        <button wire:click="delete({{ $ticket->id }})">Delete</button>
                    </th>
                </tr>
            @endforeach
            </tfoot>
        </table>
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
