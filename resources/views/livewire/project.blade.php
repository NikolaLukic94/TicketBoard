<div class="bg-white">
    <form wire:submit.prevent="store" method="POST" class="w-1/2 mx-auto py-auto bg-gray-100">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Name
            </label>
            <input type="text" placeholder="Enter Name"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   name="name" id="name"
                   wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Description
            </label>
            <input type="text" placeholder="Enter Name"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   name="description" id="description"
                   wire:model="description">
            @error('description') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        @if($updateMode)
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Members
                </label>
                <div
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($users as $user)
                        <input type="checkbox"
                               wire:click="addProjectMembers({{ $user->id }})"
                               @if (in_array($user->id, $projectMembers))
                               checked
                            @endif
                        ><span class="pl-3">{{ $user->name }}</span><br>
                    @endforeach
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
        @else
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Members
                </label>
                <div
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($users as $user)
                        <input type="checkbox" value="{{ $user->id }}"
                               wire:click="addProjectMembers({{ $user->id }})"><span
                            class="pl-3">{{ $user->name }}</span>
                        <br>
                    @endforeach
                </div>
            </div>
            <button wire:click.prevent="submitForm"
                    class="uppercase px-8 py-2 mx-auto mt-20 rounded bg-green-100 text-blue-600 max-w-max shadow-sm hover:shadow-lg h-10">
                Save
            </button>
        @endif
    </form>

    @if (session()->has('message'))
        <div class="px-8 py-8 bg-white">
            <h1 class="text-1xl flex justify-center cursive mb-8 bg-green-100 h-15">{{ session('message') }}</h1>
        </div>
    @endif

    <div class="bg-white">
        <h1 class="text-3xl cursive text-center mt-8 mb-8">Projects</h1>
        <table class='shadow-md rounded w-1/2 mx-auto py-auto'>
            <thead class='sticky block top-0' scope='col'>
            <tr class='flex text-left'>
                <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white border-r-0 border-gray-300 font-normal'>
                    <h4 class='u-slab'>Name</h4>
                </th>
                <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white border-r-0 border-gray-300 font-normal'>
                    <h4 class='u-slab'>Description</h4>
                </th>
                <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white border-r-0 border-gray-300 font-normal'>
                    <h4 class='u-slab'>Members</h4>
                </th>
                <th scope='col' class='w-1/3 sm:w-1/4 p-4 border bg-white rounded-tr border-gray-300 font-normal'>
                    <h4 class='u-slab'>Action</h4>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($projects as $project)
                <tr class='flex text-left bg-white'>
                    <th scope='col'
                        class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{substr($project->name, 0, 7)}}</th>
                    <th scope='col'
                        class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>{{substr($project->description, 0, 7)}}</th>
                    <th scope='col'
                        class='w-1/3 sm:w-1/4 p-4 border border-r-0 border-t-0 border-gray-300 flex flex-col'>
                        @foreach($project->members->pluck('name') as $member)
                            {{substr($member, 0, 7)}} <br>
                        @endforeach
                    </th>
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
