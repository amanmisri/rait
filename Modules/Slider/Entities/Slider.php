<?php

namespace Modules\Slider\Entities;

use Modules\Admin\Ui\AdminTable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Modules\Support\Eloquent\Translatable;

class Slider extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations', 'slides'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['autoplay', 'autoplay_speed', 'arrows', 'fade'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($slider) {
            $slider->saveSlides(request('slides', []));

            Cache::forget("slider_with_slides.{$slider->id}");
        });
    }

    public static function findWithSlides($id)
    {
        return Cache::rememberForever("slider_with_slides.{$id}", function () use ($id) {
            return static::with('slides')->find($id);
        });
    }

    public function table()
    {
        return new AdminTable($this->newQuery());
    }

    /**
     * Save slides for the slider.
     *
     * @param array $slides
     * @return void
     */
    public function saveSlides($slides)
    {
        $this->slides()->delete();

        foreach ($slides as $slide) {
            $this->slides()->create($slide);
        }
    }

    public function slides()
    {
        return $this->hasMany(SliderSlide::class);
    }

    public function getAutoplaySpeedAttribute($autoplaySpeed)
    {
        return $autoplaySpeed ?: 3000;
    }
}
