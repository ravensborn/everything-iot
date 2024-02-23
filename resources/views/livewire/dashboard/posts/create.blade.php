<div>
    <div id="fake-form">

        <div class="row">
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
            <div class="col-12 col-md-6">
                <label for="category_id" class="form-label">Category</label>
                <select id="category_id" class="form-control" wire:model="category_id">
                    <option value="0"> -- Select a category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12 col-md-6 mt-3 mt-md-0">
                <label for="locale" class="form-label">Language</label>
                <select id="locale" class="form-control" wire:model="locale">
                    <option value="0"> -- Select a language --</option>
                    @foreach(config('app.available_locales') as $code => $item)
                        <option value="{{ $code }}">
                            {{ $item['name'] }}
                        </option>
                    @endforeach
                </select>
                @error('locale')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-6">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" name="hiddenPost" type="checkbox" value=""
                               id="hiddenProductCheckbox" wire:model="is_hidden">
                        <label class="form-check-label" for="hiddenProductCheckbox">
                            Hidden post
                        </label>
                    </div>
                </div>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" name="isCommentable" type="checkbox" value=""
                               id="isCommentableCheckbox" wire:model="is_commentable">
                        <label class="form-check-label" for="isCommentableCheckbox">
                            Is commentable
                        </label>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-3">
            <hr>
            <button class="btn btn-primary" wire:click.prevent="createPost">
                <i class="bi bi-check2 me-1"></i>
                Create
                <span wire:loading wire:target="createPost">
                    - Saving...
                </span>
            </button>
        </div>
        <div class="mt-3">
            <a href="{{ route('dashboard.posts.index') }}">Return to list of posts.</a>
        </div>
    </div>


</div>
