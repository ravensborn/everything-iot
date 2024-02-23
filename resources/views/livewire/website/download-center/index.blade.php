<div>
    <div class="container content-space-1 content-space-lg-1">

        <div class="d-grid gap-3">
            <!-- Search -->
            <div class="mb-4">

                @if($search)
                    <div class="mb-3">
                        <h4>{{ $loadedFiles->count() }} {{ __('website.downloads.results') }} <span class="text-body small">{{ __('website.downloads.for') }} "{{ $search }}"</span></h4>
                    </div>
                    @endif

                <form>
                    <!-- Input Card -->
                    <div class="input-card border">
                        <div class="input-card-form">
                            <label for="searchAppsForm" class="form-label visually-hidden">{{ __('website.downloads.search_for_files') }}</label>
                            <div class="input-group input-group-merge">
          <span class="input-group-prepend input-group-text">
            <i class="bi-search"></i>
          </span>
                                <input type="text" class="form-control" id="searchAppsForm"
                                       placeholder="{{ __('website.downloads.search_for_files') }}" aria-label="Search for files" wire:model="search">
                            </div>
                        </div>
                        <button class="btn btn-primary" wire:click.prevent="">
                            <i class="bi-arrow-right"></i>
                        </button>
                    </div>
                    <!-- End Input Card -->
                </form>
            </div>
            <!-- End Search -->
        </div>

        <div class="row mb-5">
          @foreach($loadedFiles as $file)
                <div class="col-4 mb-3 mb-sm-4">
                    <!-- Card -->
                    <a class="card card-sm card-bordered card-transition h-100" href="{{ $file->getFirstMediaUrl('files') }}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title text-inherit">{{ $file->name }}</h5>
                                    <p class="card-text text-body small">{{ $file->description }}</p>
                                    <p class="card-text text-body small">{{ $file->getFirstMedia('files')->size / 100 }} KB</p>
                                </div>
                                <!-- End Col -->

                                <div class="col-auto">
              <span class="text-muted">
                <i class="bi-chevron-right small"></i>
              </span>
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </a>
                    <!-- End Card -->
                </div>
          @endforeach
            <div>
                {{ $loadedFiles->links() }}
            </div>
        </div>
        <!-- End Row -->

    </div>
</div>
