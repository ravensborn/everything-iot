<div>


    <form action="">
        <div>
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" wire:model="userName">
            @error('userName')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mt-3">
            <label for="Email" class="form-label">E-Mail</label>
            <input type="email" name="Email" id="Email" class="form-control" wire:model="userEmail">
            @error('userEmail')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mt-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" name="phone" id="phone" class="form-control" wire:model="userPhoneNumber">
            @error('userPhoneNumber')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mt-3">
            <button class="btn btn-primary" wire:click.prevent="updateUser">
                <i class="bi bi-check2 me-1"></i>
                Update
            </button>
        </div>
        <div class="mt-3">
            <a href="{{ route('dashboard.users.index') }}">Return to list of users.</a>
        </div>
    </form>


</div>
