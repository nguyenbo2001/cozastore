@extends('layouts.app')

@section('content')
<div class="bg0 m-t-23 p-b-140">
  <div class="container">
    <div class="flex-w flex-sb-m p-b-52">
      <div class="flex-w flex-l-m filter-tope-group m-tb-10">
        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
          All Products
        </button>

        @foreach ($product_categories as $category)
        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{ strtolower($category->slug) }}">
          {{ ucfirst($category->name) }}
        </button>
        @endforeach

      </div>

      <div class="flex-w flex-c-m m-tb-10">
        <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
          <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
          <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
          Filter
        </div>

        <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
          <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
          <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
          Search
        </div>
      </div>

      <!-- Search product -->
      <div class="dis-none panel-search w-full p-t-10 p-b-15">
        <div class="bor8 dis-flex p-l-15">
          <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
            <i class="zmdi zmdi-search"></i>
          </button>

          <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search" data-action="{{ route('products', array_merge(\Request::query(), [])) }}">
        </div>
      </div>

      <!-- Filter -->
      <div class="dis-none panel-filter w-full p-t-10">
        <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
          <div class="filter-col1 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
              Sort By
            </div>

            <ul>
              @if (array_sort_by)
              @foreach (array_sort_by as $key => $sort_item)
              <li class="p-b-6">
                <a href="{{ route('products', array_merge(\Request::query(), ['sort' => $key])) }}" class="filter-link stext-106 trans-04 {{ $key }}@if (\Request::query('sort') == $key) filter-link-active @endif">
                  {{ ucfirst($sort_item) }}
                </a>
              </li>
              @endforeach
              @endif
            </ul>
          </div>

          <div class="filter-col2 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
              Price
            </div>

            <ul>
              @if (array_sort_price)
              @foreach (array_sort_price as $key => $item_price)
              <li class="p-b-6">
                <a href="{{ route('products', array_merge(\Request::query(), ['price' => $key])) }}" class="filter-link stext-106 trans-04 @if (\Request::query('price') == $key) filter-link-active @endif">
                  {{ $item_price }}
                </a>
              </li>
              @endforeach
              @endif
            </ul>
          </div>

          <div class="filter-col3 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
              Color
            </div>

            <ul>
              @foreach ($product_colors as $color)
              <li class="p-b-6">
                <span class="fs-15 lh-12 m-r-6" style="color: {{ $color->color }};">
                  <i class="zmdi zmdi-circle"></i>
                </span>

                <a href="{{ route('products', array_merge(\Request::query(), ['color' => $color->slug])) }}" class="filter-link stext-106 trans-04 @if (\Request::query('color') == $color->slug) filter-link-active @endif">
                  {{ ucfirst($color->name) }}
                </a>
              </li>
              @endforeach
            </ul>
          </div>

          <div class="filter-col4 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
              Tags
            </div>

            <div class="flex-w p-t-4 m-r--5">
              <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                Fashion
              </a>

              <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                Lifestyle
              </a>

              <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                Denim
              </a>

              <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                Streetstyle
              </a>

              <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                Crafts
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row isotope-grid">
      @foreach ($products as $product)
      <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ strtolower($product->category->slug) }}">
        <!-- Block2 -->
        <div class="block2">
          <div class="block2-pic hov-img0">
            <img src="{{ $product->images[0]->product_image }}" alt="{{ $product->name }}">

            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-link="{{ route('modalProduct', ['product' => $product]) }}">
              Quick View
            </a>
          </div>

          <div class="block2-txt flex-w flex-t p-t-14">
            <div class="block2-txt-child1 flex-col-l ">
              <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                {{ ucfirst($product->name) }}
              </a>

              <span class="stext-105 cl3">
                {{ $product->price }}
              </span>
            </div>

            <div class="block2-txt-child2 flex-r p-t-3">
              <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                <img class="icon-heart1 dis-block trans-04" src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON">
                <img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Load more -->
    <div class="flex-c-m flex-w w-full p-t-45">
      <!-- <a href="javascript:;" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04 load-more-btn" data-next-page-url="{{ $products->nextPageUrl() }}" data-load-more-link="{{ route('loadMoreProduct', ['current_page' => $products->currentPage()]) }}">
            Load More
          </a> -->
      {{ $products->links() }}
    </div>
  </div>
</div>
@endsection