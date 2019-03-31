<?php

namespace Modules\Menu\MegaMenu;

use Modules\Menu\Entities\Menu as MenuModel;

class MegaMenu
{
    private $menuId;
    private $menus;

    public function __construct($menuId)
    {
        $this->menuId = $menuId;
    }

    public function menus()
    {
        if (! is_null($this->menus)) {
            return $this->menus;
        }

        return $this->menus = $this->getMenus()->map(function ($menu) {
            return new Menu($menu);
        });
    }

    private function getMenus()
    {
        if (is_null($this->menuId)) {
            return collect();
        }

        return MenuModel::findOrNew($this->menuId)
            ->menuItems()
            ->with(['category', 'page'])
            ->orderByRaw('-position DESC')
            ->get()
            ->noCleaning()
            ->nest()
            ->where('menu_id', $this->menuId);
    }
}
