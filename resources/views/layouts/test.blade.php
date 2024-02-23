<!-- Time Net -->

<!-- End Time Net -->

<!-- Store -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('store.index') }}">Store</a>
</li>
<!-- End Store -->

<!-- Articles -->
<li class="nav-item">
    <a class="nav-link"
       href="{{ route('posts.index', ['grid_type' => 'grid', 'slug' => 'articles']) }}">Articles</a>
</li>
<!-- End Articles -->

<!-- Support -->
<li class="hs-has-sub-menu nav-item">
    <a id="pagesMegaMenu" class="hs-mega-menu-invoker nav-link dropdown-toggle" href="#"
       role="button" data-bs-toggle="dropdown" aria-expanded="false">Support</a>
    <!-- Mega Menu -->
    <div class="hs-sub-menu dropdown-menu" aria-labelledby="pagesMegaMenu"
         style="min-width: 14rem;">
        <a class="dropdown-item" href="{{ route('downloads') }}">Downloads</a>
        <a class="dropdown-item" href="{{ route('faq') }}">FAQ</a>
    </div>
    <!-- End Mega Menu -->
</li>
<!-- End Support -->

<!-- About -->
<li class="nav-item">
    <a class="nav-link " href="{{ route('about') }}">About Us</a>
</li>
<!-- End About -->

<!-- Language -->
<li class="hs-has-sub-menu nav-item">
    <a id="pagesMegaMenu" class="hs-mega-menu-invoker nav-link dropdown-toggle" href="#"
       role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-globe2"></i>
    </a>
    <!-- Mega Menu -->
    <div class="hs-sub-menu dropdown-menu" aria-labelledby="pagesMegaMenu"
         style="min-width: 14rem;">
        <a class="dropdown-item" href="#">
            <div class="d-flex align-items-center">
                <img style="width: 16px; height: auto;"
                     src="{{ asset('themes/front/assets/vendor/flag-icon-css/flags/4x3/us.svg')  }}"
                     alt="flag icon">
                &nbsp;
                English (United States)
            </div>
        </a>
        <a class="dropdown-item" href="{{ route('soon') }}">
            <div class="d-flex align-items-center">
                <img style="width: 16px; height: auto;"
                     src="{{ asset('images/kurdistan-flag.svg')  }}" alt="flag icon">
                &nbsp;
                Kurdish (کوردی)
            </div>
        </a>
        <a class="dropdown-item" href="{{ route('soon') }}">
            <div class="d-flex align-items-center">
                <img style="width: 16px; height: auto;"
                     src="{{ asset('themes/front/assets/vendor/flag-icon-css/flags/4x3/iq.svg')  }}"
                     alt="flag icon">
                &nbsp;
                Arabic (العربیة)
            </div>
        </a>

    </div>
    <!-- End Mega Menu -->
</li>
<!-- End Language -->


<!-- Button -->
<li class="nav-item">
    <a class="btn btn-light btn-transition btn-sm" href="tel:9647503807676" target="_blank">
        <i class="bi bi-telephone"></i>
        &nbsp;
        Contact Us
    </a>
</li>
<!-- End Button -->
