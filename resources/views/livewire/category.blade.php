<div class="bg-white">
    <div>
        <form wire:submit.prevent="submitForm" method="POST" class="w-1/2 mx-auto py-auto bg-gray-100">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input type="text" placeholder="Enter Name"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       name="name" id="name"
                       wire:model="name">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Project
                </label>
                <select wire:model="projectId" name="projectId" id="projectId"
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">--- Select ---</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}"
                                @if ($projectId === $project->id) selected @endif >{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            @if($updateMode)
                <button wire:click.prevent="update"
                        class="uppercase px-8 py-2 mx-auto mt-20 rounded bg-green-100 text-blue-600 max-w-max shadow-sm hover:shadow-lg h-10">
                    Update
                </button>
                <button wire:click.prevent="cancel"
                        class="uppercase px-8 py-2 mx-auto mt-20 rounded bg-green-100 text-blue-600 max-w-max shadow-sm hover:shadow-lg h-10">
                    Cancel
                </button>
            @else
                <button wire:click.prevent="submitForm"
                        class="uppercase px-8 py-2 mx-auto mt-20 rounded bg-green-100 text-blue-600 max-w-max shadow-sm hover:shadow-lg h-10">
                    Save
                </button>
            @endif
        </form>
    </div>

    @if (session()->has('message'))
        <div class="px-8 py-8">
            <h1 class="text-1xl flex justify-center cursive mb-8 bg-green-100 h-15">{{ session('message') }}</h1>
        </div>
    @endif

    <body class="antialiased sans-serif bg-gray-200">
    <div class="container mx-auto py-6 px-4">
        <h1 class="text-3xl py-4 border-b mb-10">Categories</h1>

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
                            Name
                        </th>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            Project
                        </th>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">
                            Added
                        </th>
                        <th class="bg-gray-800 sticky top-0 border-b border-gray-200 px-6 py-2 text-white font-bold tracking-wider uppercase text-xs">

                        </th>
                    </div>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
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
                            <p class="text-gray-700 px-6 py-3 flex items-center">{{ substr($category->name, 0, 7) }}</p>
                        </td>
                        <td class="border-dashed border-t border-gray-200 firstName">
                        <span
                            class="text-gray-700 px-6 py-3 flex items-center">{{substr($category->project->name, 0, 7)}}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 lastName">
                    <span
                        class="text-gray-700 px-6 py-3 flex items-center">{{ $category->created_at->diffForHumans() }}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 gender">
                        <span class="text-gray-700 px-6 py-3 flex items-center">
                        <button wire:click="edit({{ $category->id }})">Edit</button>
                        <button wire:click="delete({{ $category->id }})">Delete</button>
                        </span>
                        </td>
                    </tr>
                    </tbody>
                    @endforeach

                    </tbody>
            </table>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab:400,700&display=swap');

        body {
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

        .u-slab {
            font-family: 'Roboto Slab', serif;
        }


        .tick {
            list-style-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='none' stroke='rgb(102, 126, 234)' class='text-indigo-700' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ctitle id='catTitle'%3ERelevant package title ( too many to add )%3C/title%3E%3Cpath d='M20 6L9 17l-5-5'/%3E%3C/svg%3E");

        }
    </style>
