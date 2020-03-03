<div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="{{ route('front.index') }}" class="js-logo-clone">Audrey Collection</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li><a href="{{ route('front.index') }}">Home</a></li>
                <li><a href="{{ route('front.produk') }}">Produk</a></li>
                <li><a href="contact.html">Kategori</a></li>
              </ul>
            </nav>
          </div>
          <div class="icons">
            <a href="{{ route('front.list_cart') }}" class="icons-btn d-inline-block bag">
              <span class="icon-shopping-bag"></span>
              {{-- <span class="number">2</span> --}}
            </a>
            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
          </div>
        </div>
      </div>
