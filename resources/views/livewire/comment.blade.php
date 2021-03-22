<div class="mx-auto justify-between mt-2 ml-16">
    <form wire:submit.prevent="submitForm" method="POST" class="w-full mx-auto py-auto bg-gray-100">
        @csrf
        <input type="text"
               wire:model="comment"
               placeholder="Custom focus style"
               class="w-1/3 focus:outline-none focus:ring focus:border-blue-300 ..." />
        <button class="bg-gray-400 text-gray-300 w-1/6" wire:click.prevent="submitForm" type="submit">Post</button>
    </form>

    <hr>
    @foreach($comments as $comment)
        <div class="w-13 p-4">
            <b>{{ $comment->user->name }}</b>
            <br>
            <p class="pt-2">{{ $comment->content }}</p>
        </div>
    @endforeach
</div>
