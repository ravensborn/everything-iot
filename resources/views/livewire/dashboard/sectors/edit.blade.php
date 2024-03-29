<div>


    <div id="fake-form">

        <div class="row">
            <div class="col-12">
                <div>
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" class="form-control" wire:model="name">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mt-3">
            <hr>
            <button class="btn btn-primary" wire:click.prevent="update">
                <i class="bi bi-check2 me-1"></i>
                Update
                <span wire:loading wire:target="update">
                    - Saving...
                </span>
            </button>
        </div>
        <div class="mt-3">
            <a href="{{ route('dashboard.sectors.index') }}">Return to list of sectors.</a>
        </div>
    </div>


</div>
