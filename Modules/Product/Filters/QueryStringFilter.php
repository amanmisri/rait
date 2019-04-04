<?php

namespace Modules\Product\Filters;

use Modules\Attribute\Entities\Attribute;

class QueryStringFilter
{
    private $sorts = [
        'relevance' => 'relevance',
        'toprated' => 'topRated',
        'latest' => 'latest',
        'pricelowtohigh' => 'priceLowToHigh',
        'pricehightolow' => 'priceHighToLow',
    ];

    public function sort($query, $sortType)
    {
        if ($this->sortTypeExists($sortType)) {
            return $this->{$sortType}($query);
        }

        return $query;
    }

    private function sortTypeExists($sortType)
    {
        return array_key_exists(strtolower($sortType), $this->sorts);
    }

    public function relevance($query)
    {
        return $query;
    }

    public function topRated($query)
    {
        return $query->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->selectRaw('AVG(reviews.rating) as avg_rating')
            ->groupBy([
                'products.id',
                'slug',
                'price',
                'special_price',
                'selling_price',
                'special_price_start',
                'special_price_end',
                'in_stock',
                'new_from',
                'new_to',
            ])
            ->orderByDesc('avg_rating');
    }

    public function latest($query)
    {
        $query->latest();
    }

    public function priceLowToHigh($query)
    {
        return $query->orderBy('selling_price');
    }

    public function priceHighToLow($query)
    {
        return $query->orderByDesc('selling_price');
    }

    public function fromPrice($query, $price)
    {
        return $query->where('selling_price', '>=', $price);
    }

    public function toPrice($query, $price)
    {
        return $query->where('selling_price', '<=', $price);
    }

    public function category($query, $slug)
    {
        return $query->whereHas('categories', function ($categoryQuery) use ($slug) {
            $categoryQuery->where('slug', $slug);
        });
    }

    public function attribute($query, $attributeFilters)
    {
        return $query->whereHas('attributes', function ($productAttributesQuery) use ($attributeFilters) {
            $this->whereAttributesNames($productAttributesQuery, array_keys($attributeFilters))
                ->whereAttributesValues($productAttributesQuery, array_flatten($attributeFilters));
        });
    }

    private function whereAttributesNames($productAttributesQuery, $attributesNames)
    {
        $productAttributesQuery->whereHas('attribute', function ($attributeQuery) use ($attributesNames) {
            $attributeQuery->where('is_filterable', true)
                ->whereTranslationIn('name', $attributesNames, locale());
        });

        return $this;
    }

    private function whereAttributesValues($productAttributesQuery, $attributesValues)
    {
        $productAttributesQuery->whereHas('values', function ($productValuesQuery) use ($attributesValues) {
            $productValuesQuery->whereHas('attributeValue', function ($attributeValueQuery) use ($attributesValues) {
                $attributeValueQuery->whereTranslationIn('value', $attributesValues, locale());
            });
        });

        return $this;
    }
}
