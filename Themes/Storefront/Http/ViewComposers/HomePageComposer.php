<?php

namespace Themes\Storefront\Http\ViewComposers;

use Illuminate\Support\Collection;
use Modules\Product\RecentlyViewed;
use Modules\Product\Entities\Product;

class HomePageComposer
{
    /**
     * The recently viewed instance.
     *
     * @var \Modules\Product\RecentlyViewed
     */
    private $recentlyViewed;

    /**
     * Create a new instance.
     *
     * @param \Modules\Product\RecentlyViewed $recentlyViewed
     */
    public function __construct(RecentlyViewed $recentlyViewed)
    {
        $this->recentlyViewed = $recentlyViewed;
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'features' => $this->getFeatures(),
            'carouselProducts' => $this->getCarouselProducts(),
            'recentProducts' => $this->getRecentProducts(),
            'threeColumnCarouselProducts' => $this->getThreeColumnCarouselProducts(),
            'landscapeProducts' => $this->getLandscapeProducts(),
            'tabProducts' => $this->getTabProducts(),
            'twoColumnCarouselProducts' => $this->getTwoColumnCarouselProducts(),
            'recentlyViewedProducts' => $this->getRecentlyViewedProducts(),
        ]);
    }

    /**
     * Get all available features.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getFeatures()
    {
        if (! setting('storefront_features_section_enabled')) {
            return collect();
        }

        return Collection::times(4, function ($number) {
            return $this->getFeatureFor($number);
        })->filter(function ($feature) {
            return ! is_null($feature['icon']);
        });
    }

    /**
     * Get feature for the given feature number.
     *
     * @param int $number
     * @return array
     */
    private function getFeatureFor($number)
    {
        return [
            'icon' => setting("storefront_feature_{$number}_icon"),
            'title' => setting("storefront_feature_{$number}_title"),
            'subtitle' => setting("storefront_feature_{$number}_subtitle"),
        ];
    }

    private function getRecentProducts()
    {
        if (! setting('storefront_recent_products_section_enabled')) {
            return collect();
        }

        return Product::forCard()
            ->latest()
            ->take(setting('storefront_recent_products_section_total_products', 10))
            ->get();
    }

    /**
     * Get carousel products.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getCarouselProducts()
    {
        if (! setting('storefront_product_carousel_section_enabled')) {
            return collect();
        }

        return $this->getProductsForCardByIds(setting('storefront_product_carousel_section_products'));
    }

    private function getTabProducts()
    {
        if (! setting('storefront_product_tabs_section_enabled')) {
            return collect();
        }

        return [
            'tab_1' => $this->getProductsForCardByIds(setting('storefront_product_tabs_section_tab_1_products')),
            'tab_2' => $this->getProductsForCardByIds(setting('storefront_product_tabs_section_tab_2_products')),
            'tab_3' => $this->getProductsForCardByIds(setting('storefront_product_tabs_section_tab_3_products')),
            'tab_4' => $this->getProductsForCardByIds(setting('storefront_product_tabs_section_tab_4_products')),
        ];
    }

    private function getThreeColumnCarouselProducts()
    {
        if (! setting('storefront_three_column_vertical_product_carousel_section_enabled')) {
            return collect();
        }

        return [
            'column_1' => $this->getProductsForCardByIds(setting('storefront_three_column_vertical_product_carousel_section_column_1_products')),
            'column_2' => $this->getProductsForCardByIds(setting('storefront_three_column_vertical_product_carousel_section_column_2_products')),
            'column_3' => $this->getProductsForCardByIds(setting('storefront_three_column_vertical_product_carousel_section_column_3_products')),
        ];
    }

    private function getLandscapeProducts()
    {
        if (! setting('storefront_landscape_products_section_enabled')) {
            return collect();
        }

        return $this->getProductsForCardByIds(setting('storefront_landscape_products_section_products'));
    }

    private function getTwoColumnCarouselProducts()
    {
        if (! setting('storefront_two_column_product_carousel_section_enabled')) {
            return collect();
        }

        return [
            'column_1' => $this->getProductsForCardByIds(setting('storefront_two_column_product_carousel_section_column_1_products')),
            'column_2' => $this->getProductsForCardByIds(setting('storefront_two_column_product_carousel_section_column_2_products')),
        ];
    }

    private function getProductsForCardByIds($ids)
    {
        return Product::forCard()
            ->whereIn('id', $ids ?: [])
            ->get();
    }

    /**
     * Get recently viewed products.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getRecentlyViewedProducts()
    {
        if (! setting('storefront_recently_viewed_section_enabled')) {
            return collect();
        }

        return collect($this->recentlyViewed->products())
            ->reverse()
            ->take(setting('storefront_recently_viewed_section_total_products', 5));
    }
}
