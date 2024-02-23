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
            <div class="row mt-3">
                <div class="col-12">
                    <div>
                        <label for="image" class="d-block form-label">Upload Partner Image</label>
                        <input type="file" id="image" class="form-control-file" wire:model="image">
                        @error('image')
                        <div>
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    @if ($image)
                        <div class="mt-3">
                            Preview:
                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid"
                                 style="width: 200px; height: auto;" alt="Partner Image">
                        </div>
                    @endif

                </div>
            </div>
            <div class="row mt-4">
                <div class="col-6">
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" name="is_visible" type="checkbox" value=""
                                   id="isVisibleCheckbox" wire:model="is_visible">
                            <label class="form-check-label" for="isVisibleCheckbox">
                                Is Visible
                            </label>
                        </div>
                    </div>
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
            <a href="{{ route('dashboard.partners.index') }}">Return to list of partners.</a>
        </div>
    </div>


</div>
