<div>


    <div id="fake-form">

        <div class="row">
            <div class="col-12">
                <div>
                    <label for="category_id" class="form-label">Category</label>
                    <select id="category_id" class="form-control" wire:model="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div>
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" class="form-control" wire:model="title">
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div>
                    <label for="description" class="form-label">Description <small class="text-muted">(50,000 Characters)</small></label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" wire:model="description"></textarea>
                    @error('description')
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
            <a href="{{ route('dashboard.faq-items.index') }}">Return to list of FAQs.</a>
        </div>
    </div>


</div>
