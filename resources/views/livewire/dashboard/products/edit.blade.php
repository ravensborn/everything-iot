<div>


    <div id="fake-form">

        <div class="row">
            <div class="col-6">
                <div>
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" class="form-control" wire:model="name">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div>
                    <label for="lc_country_id" class="form-label">Country</label>
                    <select id="lc_country_id" class="form-control" wire:model="lc_country_id">
                        @foreach($countries as $country)
                            <option value="{{ $country->lc_country_id }}">
                                {{ $country->country->iso_alpha_3 }}
                            </option>
                        @endforeach
                    </select>
                    @error('lc_country_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
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
            <div class="col-6">
                <div>
                    <label for="brand_id" class="form-label">Brand</label>
                    <select id="brand_id" class="form-control" wire:model="brand_id">
                        <option value="0"> -- Select a brand --</option>
                    @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div>
                    <label for="description">Description</label>
                    <textarea id="description" cols="30" rows="5" class="form-control" wire:model="description"></textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <div>
                    <label for="price" class="form-label">Price</label>
                    <input type="number" id="price" class="form-control" wire:model="price">
                    @error('price')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div>
                    <label for="previous_price" class="form-label">Previous Price</label>
                    <input type="number" id="previous_price" class="form-control" wire:model="previous_price">
                    @error('previous_price')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <div>
                    <label for="stock" class="form-label">Available Stock</label>
                    <input type="number" id="stock" class="form-control" wire:model="stock">
                    @error('stock')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" name="hiddenProduct" type="checkbox" value=""
                               id="hiddenProductCheckbox" wire:model="is_hidden">
                        <label class="form-check-label" for="hiddenProductCheckbox">
                            Hidden product
                        </label>
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="isPurchasableOnlineProduct" type="checkbox" value=""
                           id="isPurchasableOnlineProductPCheckbox" wire:model="is_purchasable_online">
                    <label class="form-check-label" for="isPurchasableOnlineProductPCheckbox">
                        Purchasable online
                    </label>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <label for="productFeatures" class="form-label">Product Features Array</label>

                <input type="text" id="productFeatures" class="form-control" wire:keydown.enter="addToProductFeatures"
                       wire:model="productFeature">

                <div class="mt-3 d-flex flex-row">
                    @foreach($productFeaturesArray as $item)

                        <div class="rounded bg-light tag-btn-hover me-2 mb-2 p-2 px-3"
                              style="cursor: pointer;"
                              wire:click="removeProgramFeature('{{ $item }}')">
                            <i class="bi bi-x"></i>
                            {{ $item }}
                        </div>

                    @endforeach
                </div>
            </div>

        </div>


        <div class="mt-3">
            <hr>
            <button class="btn btn-primary" wire:click.prevent="updateProduct">
                <i class="bi bi-check2 me-1"></i>
                Update
                <span wire:loading wire:target="updateProduct">
                    - Updating...
                </span>
            </button>
        </div>
        <div class="mt-3">
            <a href="{{ route('dashboard.products.index') }}">Return to list of products.</a>
        </div>
    </div>


</div>
