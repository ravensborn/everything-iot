<div>

    <!-- Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3">
                <!-- Navbar -->
                @livewire('users.account.components.navbar-component', ['active' => 'wishlist'])
                <!-- End Navbar -->
            </div>
            <!-- End Col -->

            <div class="col-lg-9">
                <div class="d-grid gap-3 gap-lg-5">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-header-title">{{ __('website.user_section.wishlist') }}</h4>
                        </div>

                        <div class="card-body">
                            @if($items->count())
                                <h5><h5>{{ __('website.user_section.items') }}</h5></h5>
                            @endif
                            <ul class="list-group">
                                @forelse($items as $item)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex justify-content-start align-items-center">

                                                <a href="{{ route('store.products.show', $item->product->slug) }}">
                                                    <img src="{{ $item->product->getCover() }}"
                                                         style="width: 64px;" alt="Item image"
                                                         class="img-thumbnail">
                                                </a>
                                                &nbsp;
                                                <div class="fw-bold text-truncate" style="width: 250px">
                                                    <a class="text-dark"
                                                       href="{{ route('store.products.show', $item->product->slug) }}">
                                                        {{ $item->product->name }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div>

                                                <span class="text-danger small d-flex align-items-center"
                                                      style="cursor:pointer;"
                                                        wire:click="removeFromWishlist({{ $item->id }})">
                                                    <i class="d-block bi bi-trash me-1"></i>
                                                    <div>
                                                        {{ __('website.user_section.remove') }}
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <div>
                                        <p>
                                            {!! __('website.user_section.wishlist_no_items') !!}
                                        </p>
                                    </div>
                                @endforelse
                            </ul>
                            <div class="mt-4">
                                {{ $items->links() }}
                            </div>
                        </div>
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
