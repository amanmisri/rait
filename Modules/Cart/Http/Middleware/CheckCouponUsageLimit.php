<?php

namespace Modules\Cart\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Cart\Facades\Cart;
use Modules\Coupon\Exceptions\CouponUsageLimitReachedException;

class CheckCouponUsageLimit
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Cart::coupon()->usageLimitReached()) {
            throw new CouponUsageLimitReachedException;
        }

        return $next($request);
    }
}
