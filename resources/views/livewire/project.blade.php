<div>
    @if($updateMode)
        <div class="grid grid-cols-3 gap-8 justify-between mx-64">
            <div class="py-6 px-3 ml-4 mr-4">
                <div class="form-group mx-8 my-8 pl-8">
                    <label for="name" class="pr-5">Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name"
                           name="name" id="name"
                           wire:model="name">
                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="py-6 px-3 mr-4">
                <div class="form-group mx-8 my-8 pl-8">
                    <label for="description" class="pr-5">Description</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1"
                           placeholder="Enter description" name="description" id="description"
                           wire:model="description">
                    @error('description') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <button wire:click.prevent="update"
                    class="uppercase px-8 py-2 mx-auto mt-20 rounded bg-green-100 text-blue-600 max-w-max shadow-sm hover:shadow-lg h-10">
                Update
            </button>
            <button wire:click.prevent="cancel"
                    class="uppercase px-8 py-2 mx-auto mt-20 rounded bg-green-100 text-blue-600 max-w-max shadow-sm hover:shadow-lg h-10">
                Cancel
            </button>
        </div>
    @else
        <form wire:submit.prevent="store" method="POST">
            @csrf
            <div class="grid grid-cols-3 gap-8 justify-between mx-64">
                <div class="py-6 px-3 ml-4 mr-4">
                    <div class="form-group mx-8 my-8 pl-8">
                        <label for="name" class="pr-5">Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name"
                               name="name" id="name"
                               wire:model="name">
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="py-6 px-3 mr-4">
                    <div class="form-group mx-8 my-8 pl-8">
                        <label for="description" class="pr-5">Description</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"
                               placeholder="Enter description" name="description" id="description"
                               wire:model="description">
                        @error('description') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <button wire:click.prevent="store"
                        class="uppercase px-8 py-2 mx-auto mt-20 rounded bg-green-100 text-blue-600 max-w-max shadow-sm hover:shadow-lg h-10">
                    Save
                </button>
            </div>
        </form>
    @endif
    <div class="px-8 py-8">
        @if (session()->has('message'))
            <h1 class="text-1xl flex justify-center cursive mb-8 bg-green-100 h-15">{{ session('message') }}</h1>
        @endif
    </div>
    <div class="min-h-screen p-12 bg-white">
        <div class="container mx-auto">
            <h1 class="text-3xl flex justify-center cursive mb-8">Projects</h1>
            <table class='shadow-md rounded max-w-5xl m-auto '>
                <thead class='sticky block top-0' scope='col'>
                <tr class='flex text-left'>
                    <th scope='row'
                        class=' hidden sm:block w-1/4 p-4 border bg-gray-100 border-r-0 rounded-tl border-gray-300'>
                        <h4 class='u-slab'>ID</h4>
                    </th>
                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white border-r-0 border-gray-300 font-normal'>
                        <h4 class='u-slab'>Name</h4>
                    </th>
                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white border-r-0 border-gray-300 font-normal'>
                        <h4 class='u-slab'>Description</h4>
                    </th>
                    <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>
                        <h4 class='u-slab'>Action</h4>
                    </th>
                </tr>
                </thead>

                <tbody>
                @foreach($projects as $project)
                    <tr class='flex text-left bg-white'>
                        <th scope='row'
                            class='w-1/4 p-4 bg-gray-100 border border-r-0 border-t-0 border-gray-300 hidden sm:block'>{{ $project->id }}</th>
                        <th scope='col'
                            class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ $project->name }}</th>
                        <th scope='col'
                            class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{ $project->description }}</th>
                        <th scope='col' class='w-1/3 sm:w-1/4 p-4 border border-t-0 border-gray-300 flex flex-col'>
                            <button wire:click="edit({{ $project->id }})">Edit</button>
                            <button wire:click="delete({{ $project->id }})">Delete</button>
                        </th>
                    </tr>
                @endforeach
                </tfoot>
            </table>
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
        justify-content: cener;
        font-family: 'Roboto', sans-serif;
        padding: 3rem 0;
    }


    .u-slab {
        font-family: 'Roboto Slab', serif;
    }


    .tick {
        list-style-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='none' stroke='rgb(102, 126, 234)' class='text-indigo-700' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ctitle id='catTitle'%3ERelevant package title ( too many to add )%3C/title%3E%3Cpath d='M20 6L9 17l-5-5'/%3E%3C/svg%3E");

    }
</style>
