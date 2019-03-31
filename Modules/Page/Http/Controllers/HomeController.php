<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Slider\Entities\Slider;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::findWithSlides(setting('storefront_slider'));

        return view('public.home.index', compact('slider'));
    }
}
