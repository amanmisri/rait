@extends('admin::layout')

@section('title', trans('admin::dashboard.dashboard'))

@section('content_header')
    <h2 class="pull-left">{{ trans('admin::dashboard.dashboard') }}</h2>
@endsection

@section('content')
<head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/core.js"></script>

</head>
    <div class="grid clearfix">
        <div class="row">
            @hasAccess('admin.orders.index')
                @include('admin::dashboard.grids.total_sales')
                @include('admin::dashboard.grids.total_orders')
            @endHasAccess

            @hasAccess('admin.products.index')
                @include('admin::dashboard.grids.total_products')
            @endHasAccess

            @hasAccess('admin.users.index')
                @include('admin::dashboard.grids.total_customers')
            @endHasAccess
        </div>
    </div>
    <div class="row">
        <div id="result" style="color:white;"></div>
    </div>
    <div class="row">
        <div class="col-md-7">
            @hasAccess('admin.orders.index')
                @include('admin::dashboard.panels.sales_analytics')
            @endHasAccess

            @hasAccess('admin.orders.index')
                @include('admin::dashboard.panels.latest_orders')
            @endHasAccess
        </div>

        <div class="col-md-5">
            @include('admin::dashboard.panels.latest_search_terms')

            @hasAccess('admin.reviews.index')
                @include('admin::dashboard.panels.latest_reviews')
            @endHasAccess
        </div>
    </div>
    <script>
            $(document).ready(function(){
               $.ajax({
                        url: "http://api.apixu.com/v1/forecast.json?key=1619860b44ed42d7a1613646190504&q=Maharashtra&days=7",
                        type: 'GET',
                        dataType: 'json',
                        success: function(res) {
                           $('#result').html(res)
                        }
                    });
            });        
    </script>
@endsection