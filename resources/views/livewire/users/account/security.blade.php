<div>

    <!-- Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3">
                <!-- Navbar -->
                @livewire('users.account.components.navbar-component', ['active' => 'security'])
                <!-- End Navbar -->
            </div>
            <!-- End Col -->

            <div class="col-lg-9">
                <div class="d-grid gap-3 gap-lg-5">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-header-title">{{ __('website.user_section.user_password') }}</h4>
                        </div>

                        <!-- Body -->
                        <div class="card-body">
                            <form>
                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="currentPassword" class="col-sm-3 col-form-label form-label">{{ __('website.user_section.current_password') }}</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="password" class="form-control" wire:model="currentPassword" id="currentPassword">
                                        </div>
                                        @error('currentPassword')
                                        <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="newPassword" class="col-sm-3 col-form-label form-label">{{ __('website.user_section.new_password') }}</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="password" class="form-control" wire:model="newPassword" id="newPassword">
                                        </div>
                                        @error('newPassword')
                                        <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="newPassword_confirmation" class="col-sm-3 col-form-label form-label">{{ __('website.user_section.confirm_new_password') }}</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="password" class="form-control" wire:model="newPassword_confirmation" id="newPassword_confirmation">
                                        </div>
                                        @error('newPassword_confirmation')
                                        <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- End Form -->

                            </form>
                        </div>
                        <!-- End Body -->

                        <!-- Footer -->
                        <div class="card-footer pt-0">
                            <div class="d-flex justify-content-end gap-3">
                                <a class="btn btn-white" href="javascript:;" wire:click="resetFields">{{ __('website.user_section.cancel') }}</a>
                                <a class="btn btn-dark" href="javascript:;" wire:click="updatePassword">{{ __('website.user_section.save_changes') }}</a>
                            </div>
                        </div>
                        <!-- End Footer -->
                    </div>
                    <!-- End Card -->

                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <!-- End Content -->

</div>
