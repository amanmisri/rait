<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            @hasSection('title')
                @yield('title') - {{ setting('store_name') }}
            @else
                {{ setting('store_name') }}
            @endif
        </title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @stack('meta')

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Rubik:400,500" rel="stylesheet">
        <link rel="stylesheet" href="{{ v(Theme::url('public/css/app.css')) }}">
        <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">

        @stack('styles')

        {!! setting('custom_header_assets') !!}

        <script>
            window.FleetCart = {
                csrfToken: '{{ csrf_token() }}',
                stripePublishableKey: '{{ setting("stripe_publishable_key") }}',
                langs: {
                    'storefront::products.loading': '{{ trans("storefront::products.loading") }}',
                },
            };
        </script>

        @stack('globals')

        @routes
    </head>

    <body class="{{ $theme }}">
        <!--[if lt IE 8]>
            <p>You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="wrapper">
            @include('public.partials.top_nav')
            @include('public.partials.header')
            @include('public.partials.navbar')
            @include('public.partials.sidebar')

            <div class="content-wrapper clearfix {{ request()->routeIs('cart.index') ? 'cart-page' : '' }}">
                <div class="container">
                    @include('public.partials.breadcrumb')

                    @unless (request()->routeIs('home') || request()->routeIs('login') || request()->routeIs('register') || request()->routeIs('reset') || request()->routeIs('reset.complete'))
                        @include('public.partials.notification')
                    @endunless

                    @yield('content')
                </div>
            </div>

            @include('public.partials.footer')

            <a class="scroll-top" href="#">
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </a>
        </div>

        @include('public.partials.quick_view_modal')

        <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
        <script src="{{ v(Theme::url('public/js/app.js')) }}"></script>
        <script src="{{ v(Theme::url('public/js/tosrus.js')) }}"></script>

        @stack('scripts')

        {!! setting('custom_footer_assets') !!}
    </body>
</html>
