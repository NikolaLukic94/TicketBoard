<div>
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" class="form-control" id="exampleInputName" placeholder="Enter name" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Contact</button>
    </form>
</div>
