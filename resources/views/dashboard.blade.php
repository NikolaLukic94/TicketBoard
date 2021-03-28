<x-app-layout>
    <div class="bg-white">
        <div class="border-b-2 border-indigo-200">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>
        </div>

        <p class="justify-around ml-8 p-8 text-gray-600">TICKETS SUMMARY</p>
        <div class="grid grid-flow-col justify-around pb-4 pr-16 pl-16">
            <div class="bg-blue-100 mt-4 pb-1 border-r-2 border-indigo-200">
                <div class='flex w-60 h-60 rounded-lg overflow-hidden mb-2 mt-2'>
                    <div class='px-2 py-3 m-auto text-gray-500'>
                        <p class="pb-2">Watching</p>
                        <p class="text-9xl">{{ $user->watchingTickets->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-100 mt-4 pb-1 border-r-2 border-indigo-200">
                <div class='flex w-60 h-60 rounded-lg overflow-hidden mb-2 mt-2'>
                    <div class='px-2 py-3 m-auto text-gray-500'>
                        <p class="pb-2">Assigned To You</p>
                        <p class="text-9xl">{{ $user->ticketProcessorTicket->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-100 mt-4 pb-1 border-r-2 border-indigo-200">
                <div class='flex w-60 h-60 rounded-lg overflow-hidden mb-2 mt-2'>
                    <div class='px-2 py-3 m-auto text-gray-500'>
                        <p class="pb-2">Due Today</p>
                        <p class="text-9xl">{{ $ticketsDueToday }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-100 mt-4 pb-1 border-r-2 border-indigo-200">
                <div class='flex w-60 h-60 rounded-lg overflow-hidden mb-2 mt-2'>
                    <div class='px-2 py-3 m-auto text-gray-500'>
                        <p class="pb-2">Mermber</p>
                        <p class="text-9xl">{{ $user->projects->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-100 mt-4 pb-1 border-r-2 border-indigo-200">
                <div class='flex w-60 h-60 rounded-lg overflow-hidden mb-2 mt-2'>
                    <div class='px-2 py-3 m-auto text-gray-500'>
                        <p class="pb-2">Author Of</p>
                        <p class="text-9xl">{{ $user->owns->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-100 mt-4 pb-1 border-r-2 border-indigo-200">
                <div class='flex w-60 h-60 rounded-lg overflow-hidden mb-2 mt-2'>
                    <div class='px-2 py-3 m-auto text-gray-500'>
                        <p class="pb-2">Urgent tickets</p>
                        <p class="text-9xl">3</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-0">
            <div>
                <p class="justify-around ml-8 p-8 text-gray-600 text-left">RECENT ACTIVITY</p>
                <div class="pb-4 pl-8 pr-8">
                    <div class="bg-blue-100 mt-4 pb-1">
                        @foreach($user->activities as $activity)
                            <p class="p-2 pl-3">
                                You {{ str_replace('_', ' ', $activity->description) }}, <b>{{ $activity->subject_id }}</b> ,{{ $activity->created_at->diffForHumans() }}
                            </p>
                            @if($activity->url)
                                <a href="{{ $activity->url . $activity->subject_id }}">See</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div>
                <p class="justify-around ml-8 p-8 text-gray-600 text-left">TODOs</p>
                <div class="pb-4 pr-8">
                    <div class="grid grid-cols-3 gap-1">
                        @foreach($user->ticketProcessorTicket as $assignedTickets)

                        <div
                            class='flex max-w-sm border-solid border-2 border-indigo-400 shadow-md rounded-md overflow-hidden mx-auto mb-1 bg-gradient-to-r from-green-200 to-blue-300'>
                            <div class='flex items-center w-full px-2 py-3'>
                                <div class='mx-3 w-full'>
                                    <div class="flex flex-row mb-6 mt-2">
                                        <div class="mr-1 h-2 w-8 bg-blue-600 rounded-full cursor-pointer"></div>
                                    </div>
                                    <div class="flex flex-row mb-4">
                                        <img class='w-14 h-14 object-cover rounded-full border-2 shadow'
                                             alt='User avatar'
                                             src='https://images.unsplash.com/photo-1477118476589-bff2c5c4cfbb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=200&q=200'>
                                        <div class="flex flex-col mb-4 ml-4 mt-1">
                                            <div class='text-gray-600 font-semibold underline pb-1 text-lg text-right'>
                                                {{ $assignedTickets->title }}
                                            </div>
                                            <div class='text-gray-600 font-base text-sm pb-1  text-right'>
                                                {{ $assignedTickets->target_date->diffForHumans() }}
                                            </div>
                                            <div
                                                class='text-white font-base text-sm italic text-right'>{{ $assignedTickets->status }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
