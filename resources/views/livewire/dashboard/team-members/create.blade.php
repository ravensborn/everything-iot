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
                    <label for="position" class="form-label">Position</label>
                    <input type="text" id="position" class="form-control" wire:model="position">
                    @error('position')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div>
                    <label for="photo" class="form-label">Photo <small class="text-muted">(Maximum size: 2MB.)</small></label>
                    <input type="file" wire:model="photo" class="form-control">
                    @error('photo')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div>
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" class="form-control" cols="30" rows="10"
                              wire:model="description"></textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" name="hiddenTeamMember" type="checkbox" value=""
                           id="hiddenTeamMemberCheckbox" wire:model="is_visible">
                    <label class="form-check-label" for="hiddenTeamMemberCheckbox">
                        Is Visible
                    </label>
                    @error('is_visible')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mt-3 mb-1">
            <div class="col-12">
                <h6>Links:</h6>
                <p>
                   The supported icon library is <a target="_blank" href="https://icons.getbootstrap.com/">Bootstrap Icon Library</a>.
                </p>
            </div>
        </div>
        @foreach($requiredLinks as $key => $link)
            <div class="row mb-1">
                <div class="col-6" wire:key="link_{{ $key }}">
                    <div>
                        <label for="name" class="form-label">{{ ucfirst($link['display_name']) }}</label>
                        <input type="text" class="form-control" id="name" wire:model="links.{{ $key }}.url">
                        @error('links.' . $key . '.url')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-6" wire:key="icon_{{ $key }}">
                    <div>
                        <label for="icon" class="form-label">Icon</label>
                        <input type="text" class="form-control" id="icon" wire:model="links.{{ $key }}.icon">
                        @error('links.' . $key . '.icon')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach


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
            <a href="{{ route('dashboard.team-members.index') }}">Return to list of team members.</a>
        </div>
    </div>


</div>
