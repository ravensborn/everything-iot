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
        <div class="row mt-3">
            <div class="col-12">
                <div>
                    <div>
                        <label for="icon" class="d-block form-label">Upload Brand Icon <small class="text-muted">(optional)</small></label>
                        <input type="file" id="icon" class="form-control-file" wire:model="icon">
                    </div>
                    @error('icon')
                        <div>
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                    @enderror
                </div>

                @if ($currentIcon)
                    <div class="mt-3">
                        Current Icon Preview:
                        <img src="{{ $currentIcon }}" class="img-fluid" style="width: 200px; height: auto;"
                             alt="Brand Icon">
                    </div>
                @endif


                @if ($icon)
                    <div class="mt-3">
                        Icon Preview:
                        <img src="{{ $icon->temporaryUrl() }}" class="img-fluid" style="width: 200px; height: auto;"
                             alt="Brand Icon">
                    </div>
                @endif

            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" name="isDisplayableOnWebsite" type="checkbox" value=""
                               id="isDisplayableOnWebsiteCheckbox" wire:model="is_displayable_on_website">
                        <label class="form-check-label" for="isDisplayableOnWebsiteCheckbox">
                            Displayable on website
                        </label>
                    </div>
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
            <a href="{{ route('dashboard.brands.index') }}">Return to list of brands.</a>
        </div>
    </div>


</div>
