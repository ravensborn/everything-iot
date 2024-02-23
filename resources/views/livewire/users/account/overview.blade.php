<div>

    <!-- Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3">
                <!-- Navbar -->
                @livewire('users.account.components.navbar-component', ['active' => 'overview'])
                <!-- End Navbar -->
            </div>
            <!-- End Col -->

            <div class="col-lg-9">
                <div class="d-grid gap-3 gap-lg-5">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-header-title">{{ __('website.user_section.basic_info') }}</h4>
                        </div>

                        <!-- Body -->
                        <div class="card-body">
                            <form>
                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label form-label">{{ __('website.user_section.full_name') }}</label>

                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" wire:model="userName" id="name" placeholder="{{ __('website.user_section.full_name') }}">
                                            @error('userName')
                                            <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="emailLabel" class="col-sm-3 col-form-label form-label">{{ __('website.user_section.email') }}</label>

                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" wire:model="userEmail" id="emailLabel" placeholder="user@example.com">
                                        @error('userEmail')
                                        <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="countryLabel" class="col-sm-3 col-form-label form-label">{{ __('website.user_section.country') }}</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="countryLabel" value="{{ $user->country->name }}" disabled>
                                    </div>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="row mb-4">
                                    <label for="phoneNumberLabel" class="col-sm-3 col-form-label form-label">{{ __('website.user_section.phone_number') }}</label>

                                    <div class="col-sm-9">
                                        <input type="tel" class="form-control" wire:model="userPhoneNumber" id="phoneNumberLabel" placeholder="7501234567">
                                        @error('userPhoneNumber')
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
                                <a class="btn btn-white" href="javascript:;" wire:click="getUser">{{ __('website.user_section.cancel') }}</a>
                                <a class="btn btn-dark" href="javascript:;" wire:click="updateUser">{{ __('website.user_section.save_changes') }}</a>
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
