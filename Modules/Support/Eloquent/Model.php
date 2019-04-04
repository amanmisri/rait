<?php

namespace Modules\Support\Eloquent;

use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
    /**
     * Register a new active global scope on the model.
     *
     * @return void
     */
    public static function addActiveGlobalScope()
    {
        static::addGlobalScope('active', function ($query) {
            $query->where('is_active', true);
        });
    }
}
