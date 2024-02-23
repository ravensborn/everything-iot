<div>

    <!-- Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3">
                <!-- Navbar -->
                @livewire('users.account.components.navbar-component', ['active' => 'orders'])
                <!-- End Navbar -->
            </div>
            <!-- End Col -->

            <div class="col-lg-9">
                <div class="d-grid gap-3 gap-lg-5">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-header-title">{{ __('website.user_section.orders') }}</h4>
                        </div>

                        <div class="card-body">
                            <p>
                               {{ __('website.user_section.orders_description') }}
                            </p>

                            <h5>
                                {{__('website.user_section.latest_orders') }}
                            </h5>

                            @forelse($orders as $order)

                                <div class="p-3 rounded mb-2 shadow-sm border border-opacity-10">

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <a href="{{  route('users.store.orders.show', ['order' => $order->id])  }}" class="d-flex align-items-center text-dark">
                                                <div class="fw-bold me-2">
                                                    <i class="bi bi-box fs-3 me-1"></i>
                                                </div>
                                                <div class=" me-2">
                                                    #{{ $order->number }}
                                                </div>
                                                <div>
                                                    <div class="badge bg-secondary">{{ $order->created_at->format('Y-m-d') }}</div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="{{  route('users.store.orders.invoice', ['order' => $order->id])  }}" class="d-flex align-items-center text-dark">
                                            <div class="badge bg-secondary d-flex align-items-center me-2">
                                                <small class="me-1">
                                                    <i class="fw-bold bi bi-receipt"></i>
                                                </small>
                                                <div>
                                                    <span class="text-capitalize">
                                                        {{ __('website.user_section.invoice') }}
                                                    </span>
                                                </div>
                                            </div>
                                            </a>
                                            <div class="badge bg-secondary d-flex align-items-center">
                                                <small class="me-1">
                                                    <i class="fw-bold bi bi-{{ $order->getStatusColorAndIcon()['icon'] }}"></i>
                                                </small>
                                                <div>
                                                    <span class="text-capitalize">
                                                        {{ $order->getStatusName() }}
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>

                            @empty
                                <p>
                                    {{ __('website.user_section.no_orders') }}
                                </p>
                            @endforelse

                            <div class="d-flex justify-content-center mt-5">
                                {{ $orders->links() }}
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
