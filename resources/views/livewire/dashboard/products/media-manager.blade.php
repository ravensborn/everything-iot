<div>
    <div class="row">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <span>Upload Images</span>
                    </h5>
                </div>
                <div class="card-body"
                >
                    <form>
                        <div wire:loading.remove wire:target="photos">
                            <label for="photos" class="form-label">Select images</label>
                            <input type="file" class="form-control" id="photos" wire:model="photos" multiple>
                            @error('photos.*')
                            <div class="text-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                        <div wire:loading wire:target="photos">
                            Uploading Photos...
                        </div>
                    </form>

                    {{--                    <div class="row">--}}
                    {{--                        <div class="col">--}}
                    {{--                            <p>Drag your images on the following box to begin uploading, recommended image aspect ratio is 1:2.</p>--}}
                    {{--                            <div--}}
                    {{--                                class="d-flex justify-content-center align-items-center"--}}
                    {{--                                x-data="drop_file_component()">--}}
                    {{--                                <div class="w-100 py-5 rounded border d-flex flex-column justify-content-center align-items-center"--}}
                    {{--                                     x-bind:class="droppingFile ? 'bg-secondary' : ''"--}}
                    {{--                                     x-on:drop="droppingFile = false"--}}
                    {{--                                     x-on:drop.prevent="handleFileDrop($event)"--}}
                    {{--                                     x-on:dragover.prevent="droppingFile = true"--}}
                    {{--                                     x-on:dragleave.prevent="droppingFile = false">--}}

                    {{--                                    <div class="text-center" wire:loading.remove wire.target="files">--}}
                    {{--                                        <i class="bi bi-cloud-arrow-up display-6"></i>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div>--}}
                    {{--                                        Drop Your Files Here--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="mt-1" wire:loading.flex wire.target="files">--}}
                    {{--                                        <div>Processing Files</div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <span>Product Images</span>
                    </h5>
                </div>
                <div class="card-body">
                <div class="row">
                    @forelse($productImages as $image)
                       <div class="col-6 col-md-3">
                          <div class="border rounded p-2 mt-3">
                              <div class="text-center mb-2">
                                 @if($product->cover_image == $image->uuid)
                                    Current Cover
                                  @else
                                      <a href="" wire:click.prevent="updateCover('{{ $image->uuid  }}')">Make cover</a>
                                  @endif
                              </div>
                              <div class="text-center">
                                  <img style="width: 200px; height: 100px; object-fit: contain;"
                                       class="img-fluid"
                                       src="{{ $image->getFullUrl() }}" alt="Product Image">
                              </div>
                              <div class="text-center mt-2">
                                  <a wire:loading.remove wire:target="removeImage('{{ $image->uuid }}')" class="text-danger" wire:click.prevent="removeImage('{{ $image->uuid  }}')">
                                      Remove
                                  </a>
                                  <div wire:loading wire:target="removeImage('{{ $image->uuid }}')">
                                        Deleting...
                                  </div>
                              </div>
                          </div>
                       </div>
                    @empty
                        <p>
                            There are no images for this product.
                        </p>
                    @endforelse
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
