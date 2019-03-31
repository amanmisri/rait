<?php

namespace Modules\Core\Foundation\Asset\Types;

use Nwidart\Modules\Facades\Module;

class ModuleAsset implements AssetType
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
        return Module::asset($this->path);
    }
}
