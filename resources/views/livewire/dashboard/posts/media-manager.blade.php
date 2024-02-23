<div>
    <div class="row">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <span>Upload Cover Image</span>
                    </h5>
                </div>
                <div class="card-body"
                >
                    <form>
                        <div wire:loading.remove wire:target="photo">
                            <label for="photo" class="form-label">Photos</label>
                            <input type="file" class="form-control" id="photo" wire:model="photo">
                            @error('photo')
                            <div class="text-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                        <div wire:loading wire:target="photo">
                            Uploading Photo...
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <span>Cover Image</span>
                    </h5>
                </div>
                <div class="card-body">
                    @if($post->hasMedia('cover'))
                        <div class="row">
                            <div class="col">
                                <a href="#" wire:click.prevent="removeCover">Remove current cover.</a>
                            </div>
                        </div>
                    @endif
                    <div class="row mt-3">
                        <div class="col">
                            @if($post->hasMedia('cover'))
                                <img style="width: 200px; height: 100px; object-fit: contain;"
                                     class="img-fluid border"
                                     src="{{ $post->getFirstMediaUrl('cover') }}" alt="Post Image">
                            @else
                                <p>
                                    This post does not have a cover image.
                                </p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        // function drop_file_component() {
        //     return {
        //         droppingFile: false,
        //         handleFileDrop(e) {
        //             if (event.dataTransfer.files.length > 0) {
        //                 const files = e.dataTransfer.files;
        //             @this.uploadMultiple('files', files,
        //                 (uploadedFilename) => {}, () => {}, (event) => {}
        //             )
        //             }
        //         }
        //     };
        // }
    </script>
</div>
