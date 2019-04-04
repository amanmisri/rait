<?php

namespace Modules\Translation\Entities;

use Illuminate\Database\Eloquent\Model;

class TranslationTranslation extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['locale', 'value'];
}
