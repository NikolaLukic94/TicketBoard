<div class="container m-auto p-8 text-grey-darkest">
    <div class="flex flex-wrap -mx-2 mb-8">
        <div class="w-full md:w-2/3 px-2 mb-4">
            <p class="p-1 pl-2 text-gray-400">
                {{ $theTicket->category->project->name }} / {{ $theTicket->uuid }}
            </p>
            <h1 class="p-2 font-bold">
                <b> {{ $theTicket->title }}</b>
            </h1>
            {{--            <div class="border h-12 text-sm text-grey-dark flex items-center justify-center">--}}
            <p class="p-2">Description</p>
            <br>
            <p class="p-2">
                {{ $theTicket->description }}
            </p>
            {{--            </div>--}}
        </div>
        <div class="w-full md:w-1/3 px-2">
            {{--            <div class="border h-12 text-sm text-grey-dark flex items-center justify-center">--}}
            <p>CREATED BY {{ $theTicket->author->name }}, {{ $theTicket->created_at->diffForHumans() }}</p>

            <p>TARGET DATE {{ $theTicket->target_date->format('Y-m-d') }}</p>
            <p>URGENCY {{ $theTicket->urgency_level }}</p>
            <p>CATEGORY {{ $theTicket->category->name }}</p>
            <p>SUBCATEGORY {{ $theTicket->subcategory->name }}</p>
            <p><b>Involved Users:</b></p>
            @foreach($theTicket->invlolvedTeamMembers as $user)
                @if($user->assigned === 1)
                    <p>Assigned To: {{ $user->name }}</p>
                @else
                    <p>Watching: {{ $user->name }}</p>
                @endif
            @endforeach
            {{--            </div>--}}
        </div>
    </div>

</div>
