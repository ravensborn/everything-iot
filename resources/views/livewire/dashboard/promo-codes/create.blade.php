<div>


    <div id="fake-form">

        <div class="row">
            <div class="col-4">
                <div>
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" class="form-control" wire:model="name">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div>
                    <label for="code" class="form-label">Code</label>
                    <input type="text" id="code" class="form-control" wire:model="code">
                    @error('code')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div>
                    <label for="max_uses" class="form-label">Max Uses</label>
                    <input type="number" id="max_uses" class="form-control" wire:model="max_uses">
                    @error('max_uses')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <div>
                    <label for="discount_type" class="form-label">Discount Type</label>
                    <select name="discount_type" id="discount_type" class="form-control" wire:model="discount_type">
                        <option value="">-- Select type --</option>
                        @foreach($discountTypes as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('discount_type')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div>
                    <label for="discount_amount" class="form-label">Discount Amount</label>
                    <input type="number" id="discount_amount" class="form-control" wire:model="discount_amount">
                    @error('discount_amount')
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
            <a href="{{ route('dashboard.promo-codes.index') }}">Return to list of promo codes.</a>
        </div>
    </div>


</div>
