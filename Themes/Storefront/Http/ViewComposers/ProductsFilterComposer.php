<?php

namespace Themes\Storefront\Http\ViewComposers;

use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Attribute\Entities\Attribute;

class ProductsFilterComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'categories' => $this->categories(),
            'attributes' => $this->attributes(),
            'maxPrice' => $this->maxPrice(),
        ]);
    }

    private function categories()
    {
        return Category::tree();
    }

    private function attributes()
    {
        return Attribute::with('values')->where('is_filterable', true)->get();
    }

    private function maxPrice()
    {
        return Product::max('selling_price');
    }
}
