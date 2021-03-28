<div class="container m-auto p-8 text-grey-darkest">
    <div class="flex flex-wrap -mx-2 mb-8">
        <div class="w-full md:w-2/3 px-2 mb-4">
            <p class="p-1 pl-2 text-gray-400">
                {{ $theTicket->category->project->name }} / {{ $theTicket->uuid }}
            </p>
            <h1 class="p-2 font-bold">
                <b> {{ $theTicket->title }}</b>
            </h1>
            <p class="p-2">Description</p>
            <br>
            <p class="p-2">
                {{ $theTicket->description }}
            </p>
        </div>
        <div class="w-full md:w-1/3 px-2">
            <div class="border w-1/2 justify-between text-center">
                <p class="text-gray-700 pb-2">Urgency</p>
                <body>
                <select class="mb-2">
                    <option @if($theTicket->urgency_level === 'Low') selected @endif>Low</option>
                    <option @if($theTicket->urgency_level === 'Medium') selected @endif>Medium</option>
                    <option @if($theTicket->urgency_level === 'High') selected @endif>High</option>
                </select>
                </body>
            </div>

            <p>CREATED BY {{ $theTicket->author->name }}, {{ $theTicket->created_at->diffForHumans() }}</p>

            <p>TARGET DATE {{ $theTicket->target_date->format('Y-m-d') }}</p>

            <p>CATEGORY {{ $theTicket->category->name }}</p>
            <p>SUBCATEGORY {{ $theTicket->subcategory->name }}</p>
            <p><b>Involved Users:</b></p>
            <p class="p-2">
                Watching
                @foreach($theTicket->invlolvedTeamMembers as $user)
                    @if($user->assigned !== 1)
                        <p>{{ $user->name }}</p>
                    @endif
                @endforeach
            <input type="text" class="mt-4 h-3.5">
            </p>
            <p class="p-2">
                Assigned To
                @foreach($theTicket->invlolvedTeamMembers as $user)
                    @if($user->assigned === 1)<p>Assigned To: {{ $user->name }}</p>@endif
                @endforeach
                </p>
        </div>
    </div>

</div>
