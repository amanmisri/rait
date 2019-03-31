<?php

namespace Themes\Storefront\Http\ViewComposers;

use Modules\Compare\Compare;
use Modules\Cart\Facades\Cart;
use Modules\Menu\Entities\Menu;
use Modules\Media\Entities\File;
use Modules\Menu\MegaMenu\MegaMenu;
use Modules\Category\Entities\Category;

class LayoutComposer
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
            'theme' => $this->getTheme(),
            'compareCount' => resolve(Compare::class)->count(),
            'favicon' => $this->getFavicon(),
            'headerLogo' => $this->getHeaderLogo(),
            'categories' => $this->getCategories(),
            'primaryMenu' => $this->getPrimaryMenu(),
            'categoryMenu' => $this->getCategoryMenu(),
            'cart' => $this->getCart(),
            'footerLogo' => $this->getFooterLogo(),
            'footerMenu' => $this->getFooterMenu(),
            'socialLinks' => $this->getSocialLinks(),
            'copyrightText' => $this->getCopyrightText(),
        ]);
    }

    private function getTheme()
    {
        return setting('storefront_theme', 'theme-blue');
    }

    private function getFavicon()
    {
        return $this->getLogo('storefront_favicon');
    }

    private function getHeaderLogo()
    {
        return $this->getLogo('storefront_header_logo');
    }

    private function getLogo($key)
    {
        if (! is_null($id = setting($key))) {
            return File::findOrNew($id)->path;
        }
    }

    private function getCategories()
    {
        return Category::searchable();
    }

    private function getPrimaryMenu()
    {
        return new MegaMenu(setting('storefront_primary_menu'));
    }

    private function getCategoryMenu()
    {
        return new MegaMenu(setting('storefront_category_menu'));
    }

    private function getCart()
    {
        return Cart::instance();
    }

    private function getFooterLogo()
    {
        return $this->getLogo('storefront_footer_logo');
    }

    private function getFooterMenu()
    {
        if (is_null(setting('storefront_footer_menu'))) {
            return collect();
        }

        return Menu::findOrNew(setting('storefront_footer_menu'))
            ->menuItems()
            ->with(['category', 'page'])
            ->get();
    }

    private function getSocialLinks()
    {
        return collect([
            'facebook-official' => setting('storefront_fb_link'),
            'twitter' => setting('storefront_twitter_link'),
            'instagram' => setting('storefront_instagram_link'),
            'linkedin' => setting('storefront_linkedin_link'),
            'pinterest' => setting('storefront_pinterest_link'),
            'google-plus' => setting('storefront_google_plus_link'),
            'youtube' => setting('storefront_youtube_link'),
        ])->reject(function ($link) {
            return is_null($link);
        });
    }

    private function getCopyrightText()
    {
        $replacements = [
            'store_url' => route('home'),
            'store_name' => setting('store_name'),
            'year' => date('Y'),
        ];

        $copyrightText = setting('storefront_copyright_text');

        foreach ($replacements as $key => $replacement) {
            $copyrightText = str_replace("{{ $key }}", $replacement, $copyrightText);
        }

        return $copyrightText;
    }
}
