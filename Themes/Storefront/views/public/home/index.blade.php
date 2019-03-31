@extends('public.layout')

@section('title', setting('store_tagline'))

@section('content')
	@unless (is_null($slider))
        <div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3">
            <div class="row">
                @include('public.home.sections.slider')
            </div>
        </div>
        <div class="clearfix"></div>
    @endunless

    @include('public.partials.notification')

    @if (setting('storefront_features_section_enabled'))
        @include('public.home.sections.features')
    @endif

    @if (setting('storefront_product_carousel_section_enabled'))
        @include('public.home.sections.product_carousel', [
            'title' => setting('storefront_product_carousel_section_title'),
            'products' => $carouselProducts
        ])
    @endif

    @if (setting('storefront_recent_products_section_enabled'))
        @include('public.home.sections.recent_products')
    @endif

    @if (setting('storefront_three_column_vertical_product_carousel_section_enabled'))
        @include('public.home.sections.three_column_vertical_product_carousel')
    @endif

    @if (setting('storefront_landscape_products_section_enabled'))
        @include('public.products.partials.landscape_products', [
            'title' => setting('storefront_landscape_products_section_title'),
            'products' => $landscapeProducts
        ])
    @endif

    @if (setting('storefront_product_tabs_section_enabled'))
        @include('public.home.sections.product_tabs')
    @endif

    @if (setting('storefront_two_column_product_carousel_section_enabled'))
        @include('public.home.sections.two_column_product_carousel')
    @endif

    @if (setting('storefront_recently_viewed_section_enabled'))
        @include('public.products.partials.landscape_products', [
            'title' => setting('storefront_recently_viewed_section_title'),
            'products' => $recentlyViewedProducts
        ])
    @endif
@endsection
