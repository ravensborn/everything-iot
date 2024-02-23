<div>
    <!-- Form -->
    <form action="">
        <div class="mb-2">
            <input type="text" wire:model="email" class="form-control" placeholder="{{ __('website.globals.enter_email') }}"
                   aria-label="Enter email">
            @error('email')
            <small class="text-danger">{{ $message  }}</small>
            @enderror
            @if($messageContext)
                <small class="text-{{ $messageType }}">{{ $messageContext  }}</small>
            @endif
        </div>
        <div class="d-grid">
            <button type="button" class="btn btn-dark" wire:loading.attr="disabled" wire:click.prevent="add">
                {{ __('website.components.subscribe_box.subscribe_button') }}
            </button>
        </div>
    </form>
    <!-- End Form -->
</div>
