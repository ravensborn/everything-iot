<div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <span>Manage Banner</span>
                    </h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div>Website Banner</div>
                            <div class="mt-1">
                                <img
                                    class="img-thumbnail"
                                    src="{{ $currentTheme->getFirstMediaUrl('website-banner') }}"
                                    style="width: 300px; height: 190px; object-fit: contain;"
                                    alt="Website Banner">
                            </div>
                            <div class="mt-3">
                                <div>
                                    <div wire:loading.remove wire:target="websiteBannerPhoto">
                                        <label for="website_banner_photo" class="form-label">Upload a new website banner <small class="text-muted">(2MB Max)</small></label>
                                        <input type="file" class="form-control" id="website_banner_photo" wire:model="websiteBannerPhoto">
                                        @error('websiteBannerPhoto')
                                        <div class="text-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div wire:loading wire:target="websiteBannerPhoto">
                                        Uploading Photo...
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="website_banner_bg_overlay" class="form-label">Background Overlay</label>
                                    <input type="text" class="form-control" wire:model="websiteBannerBgOverlay" id="website_banner_bg_overlay">
                                    @error('websiteBannerBgOverlay')
                                    <div class="text-danger mt-3">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="website_banner_bg_position" class="form-label">Background Position</label>
                                    <input type="text" class="form-control" wire:model="websiteBannerBgPosition" id="website_banner_bg_position">
                                    @error('websiteBannerBgPosition')
                                    <div class="text-danger mt-3">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3 mt-md-0">
                            <div>Store Banner</div>
                            <div class="mt-1">
                                <img
                                    class="img-thumbnail"
                                    src="{{ $currentTheme->getFirstMediaUrl('store-banner') }}"
                                    style="width: 300px; height: 190px; object-fit: contain;"
                                    alt="Store Banner">
                            </div>
                            <div class="mt-3">
                                <div>
                                    <div wire:loading.remove wire:target="storeBannerPhoto">
                                        <label for="store_banner_photo" class="form-label">Upload a new store banner <small class="text-muted">(2MB Max)</small></label>
                                        <input type="file" class="form-control" id="store_banner_photo" wire:model="storeBannerPhoto">
                                        @error('storeBannerPhoto')
                                        <div class="text-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div wire:loading wire:target="storeBannerPhoto">
                                        Uploading Photo...
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="store_banner_bg_overlay" class="form-label">Background Overlay</label>
                                    <input type="text" class="form-control" wire:model="storeBannerBgOverlay" id="store_banner_bg_overlay">
                                </div>
                                <div class="mt-3">
                                    <label for="store_banner_bg_position" class="form-label">Background Position</label>
                                    <input type="text" class="form-control" wire:model="storeBannerBgPosition" id="store_banner_bg_position">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <hr>
                            <button class="btn btn-primary px-5" wire:click="updateBanners">Save Settings</button>
                            <a href="#" wire:click.prevent="restoreDefaultCovers()">Restore default settings.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <span>Article Side Images</span>
                    </h5>
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-12">
                            <div class="row">
                                @foreach($articleSideImages as $image)
                                   <div class="col-6 mt-3 mt-md-0 col-md-3 text-center">
                                       <div class="me-3">
                                           <img src="{{ $image->getFullUrl() }}" alt="Article Side Image" class="img-thumbnail img-fluid" style="width: 200px; height: 200px; object-fit: contain;">
                                       </div>
                                       <div class="mt-1">
                                           <a wire:click.prevent="deleteArticleSideImage('{{ $image->uuid }}')">
                                               <i class="bi bi-x"></i>
                                               delete
                                           </a>
                                       </div>
                                   </div>
                                @endforeach
                            </div>
                            <div class="mt-3">
                                <div>
                                    <div wire:loading.remove wire:target="articleSideImage">
                                        <label for="articleSideImage" class="form-label">Select images to upload <small class="text-muted">(2MB Max)</small></label>
                                        <input type="file" class="form-control" id="articleSideImage" wire:model="articleSideImage">
                                        @error('articleSideImage')
                                        <div class="text-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div wire:loading wire:target="articleSideImage">
                                        Uploading Photo...
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
