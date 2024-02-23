<div>

    <div id="fake-form">

        <div class="row">
            <div class="col-12">
                <div>
                    <label for="name" class="form-label">File Name</label>
                    <input type="text" id="name" class="form-control" wire:model="name">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div>
                    <label for="description" class="form-label">File Description</label>
                    <textarea id="description" class="form-control" cols="10" rows="5" wire:model="description"></textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div>
                    <label for="file" class="form-label">File <small class="text-muted">(Allowed Types: ZIP, RAR, 7ZIP | Maximum size: 15MB.)</small></label>
                    <input type="file" wire:model="file" class="form-control">
                    @error('file')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>


        <div class="mt-3">
            <hr>
            <button class="btn btn-primary" wire:click.prevent="create">
                <i class="bi bi-check2 me-1"></i>
                Create
                <span wire:loading wire:target="create">
                    - Saving...
                </span>
            </button>
        </div>
        <div class="mt-3">
            <a href="{{ route('dashboard.download-center.index') }}">Return to list of downloadable files.</a>
        </div>
    </div>

</div>
