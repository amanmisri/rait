@extends('public.layout')

@section('breadcrumb')
    @if (request()->routeIs('account.dashboard.index'))
        <li class="active">{{ trans('storefront::account.links.my_account') }}</li>
    @else
        <li><a href="{{ route('account.dashboard.index') }}">{{ trans('storefront::account.links.my_account') }}</a></li>
    @endif

    @yield('account_breadcrumb')
@endsection

@section('content')
    <div class="row">
        <div class="my-account clearfix">
            <div class="col-md-3">
                <div class="sidebar-menu">
                    <ul class="list-inline">
                        <li class="{{ request()->routeIs('account.dashboard.index') ? 'active' : '' }}">
                            <a href="{{ route('account.dashboard.index') }}">
                                <i class="fa fa-dashboard" aria-hidden="true"></i>
                                {{ trans('storefront::account.links.dashboard') }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('account.orders.index') ? 'active' : '' }}">
                            <a href="{{ route('account.orders.index') }}">
                                <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                {{ trans('storefront::account.links.my_orders') }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('account.wishlist.index') ? 'active' : '' }}">
                            <a href="{{ route('account.wishlist.index') }}">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                {{ trans('storefront::account.links.my_wishlist') }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('account.reviews.index') ? 'active' : '' }}">
                            <a href="{{ route('account.reviews.index') }}">
                                <i class="fa fa-comment" aria-hidden="true"></i>
                                {{ trans('storefront::account.links.my_reviews') }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('account.profile.edit') ? 'active' : '' }}"">
                            <a href="{{ route('account.profile.edit') }}">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                {{ trans('storefront::account.links.my_profile') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                {{ trans('storefront::account.links.logout') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                <div class="clearfix"></div>

                <div class="content-right clearfix">
                    @yield('content_right')
                </div>
            </div>
        </div>
    </div>
@endsection
