<div>
    <div class="bg-img-start"
         style="background-image: url({{ asset('themes/front/assets/svg/components/card-11.svg') }});">
        <div class="container content-space-t-3 content-space-t-lg-5 content-space-b-2">
            <div class="w-md-75 w-lg-50 text-center mx-md-auto">
                <h1>{{ __('website.faq.faq') }}</h1>
                <p>{{ __('website.faq.faq_description') }}</p>
            </div>
        </div>
    </div>
    <!-- FAQ -->
    <div class="container content-space-2 content-space-b-lg-3">
        <div class="w-lg-75 mx-lg-auto">
            <div class="d-grid gap-10">


                <div class="d-grid gap-3">
                    <!-- Search -->
                    <div class="mb-4">

                        @if($search)
                            <div class="mb-3">
                                <h4>{{ $faqItemsCount }} {{ __('website.faq.results') }} <span
                                        class="text-body small">{{ __('website.faq.for') }} "{{ $search }}"</span></h4>
                            </div>
                        @endif

                        <form>
                            <!-- Input Card -->
                            <div class="input-card border">
                                <div class="input-card-form">
                                    <label for="searchAppsForm" class="form-label visually-hidden">{{ __('website.faq.search_for_questions') }}</label>
                                    <div class="input-group input-group-merge">
          <span class="input-group-prepend input-group-text">
            <i class="bi-search"></i>
          </span>
                                        <input type="text" class="form-control" id="searchAppsForm"
                                               placeholder="{{ __('website.faq.search_for_questions') }}" aria-label="Search for questions"
                                               wire:model="search">
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

                @foreach($categories as $categoryIndex => $category)
                    <div class="d-grid gap-3">
                        <h2>{{ ucwords($category->name) }}</h2>
                        <!-- Accordion -->
                        @foreach($category->faqItems as $faqIndex => $item)
                            <div class="accordion accordion-flush accordion-lg" id="accordion{{ $categoryIndex }}">
                                <!-- Accordion Item -->
                                <div class="accordion-item">
                                    <div class="accordion-header" id="heading{{ $categoryIndex . $faqIndex }}">
                                        <a class="accordion-button collapsed" role="button" data-bs-toggle="collapse"
                                           data-bs-target="#collapse{{ $categoryIndex . $faqIndex }}" aria-expanded="false"
                                           aria-controls="collapse{{ $categoryIndex . $faqIndex }}">
                                            {{ $item->title }}
                                        </a>
                                    </div>
                                    <div id="collapse{{ $categoryIndex . $faqIndex }}" class="accordion-collapse collapse"
                                         aria-labelledby="heading{{ $categoryIndex . $faqIndex }}" data-bs-parent="#accordion{{ $categoryIndex }}">
                                        <div class="accordion-body">
                                            {{ $item->description }}
                                        </div>
                                    </div>
                                </div>
                                <!-- End Accordion Item -->
                            </div>
                        @endforeach
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- End FAQ -->
</div>
