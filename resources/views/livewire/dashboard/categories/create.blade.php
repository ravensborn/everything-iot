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
                    <label for="model" class="form-label">Model</label>
                    <select name="model" id="model" class="form-control" wire:model="model">
                        <option value="">-- Select model --</option>
                        @foreach($models as $model)
                            <option value="{{ $model['class'] }}">{{ $model['name'] }}</option>
                        @endforeach
                    </select>
                    @error('model')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>


        <div class="mt-3">
            <hr>
            <button class="btn btn-primary" wire:click.prevent="createCategory">
                <i class="bi bi-check2 me-1"></i>
                Create
                <span wire:loading wire:target="createCategory">
                    - Saving...
                </span>
            </button>
        </div>
        <div class="mt-3">
            <a href="{{ route('dashboard.categories.index') }}">Return to list of categories.</a>
        </div>
    </div>


</div>
