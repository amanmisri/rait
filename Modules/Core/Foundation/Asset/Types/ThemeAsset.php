<?php

namespace Modules\Core\Foundation\Asset\Types;

use Theme;

class ThemeAsset implements AssetType
{
    /**
     * @var string
     */
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Get the URL.
     *
     * @return string
     */
    public function url()
    {
        return Theme::url($this->path);
    }
}
