<?php

namespace Modules\Translation\Entities;

use Modules\Support\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Modules\Support\Eloquent\Translatable;

class Translation extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['value'];

    /**
     * Clear translations cache.
     *
     * @return bool
     */
    public static function clearCache()
    {
        return Cache::flush();
    }

    /**
     * Retrieve all translations.
     *
     * @return void
     */
    public static function retrieve()
    {
        return array_replace_recursive(static::getFileTranslations(), static::getDatabaseTranslations());
    }

    /**
     * Get file translations.
     *
     * @return array
     */
    private static function getFileTranslations()
    {
        $translations = [];

        foreach (resolve('translation.loader')->paths() as $hint => $path) {
            foreach (supported_locales() as $locale => $language) {
                foreach (glob("{$path}/{$locale}/*.php") as $file) {
                    foreach (array_dot(require $file) as $key => $value) {
                        $group = str_replace('.php', '', basename($file));

                        $translations["{$hint}::{$group}.{$key}"][$locale] = $value;
                    }
                }
            }
        }

        return $translations;
    }

    /**
     * Get database translations.
     *
     * @return array
     */
    private static function getDatabaseTranslations()
    {
        $translations = static::with(['translations' => function ($query) {
            $query->withoutGlobalScope('locale');
        }])->get();

        return self::formatTranslations($translations);
    }

    /**
     * Format database translations.
     *
     * @param \Illuminate\Database\Eloquent\Collection $translations
     * @return array
     */
    private static function formatTranslations($translations)
    {
        $formatted = [];

        foreach ($translations as $translation) {
            foreach ($translation->translations as $translationTranslation) {
                $formatted[$translation->key][$translationTranslation->locale] = $translationTranslation->value;
            }
        }

        return $formatted;
    }
}
