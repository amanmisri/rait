<?php

namespace Modules\Setting\Providers;

use Modules\Support\Traits\AddsAsset;
use Modules\Setting\Admin\SettingTabs;
use Illuminate\Support\ServiceProvider;
use Modules\Support\Traits\LoadsConfig;
use Modules\Admin\Ui\Facades\TabManager;
use Illuminate\Support\Facades\Validator;
use Modules\Setting\Validators\RedisValidator;

class SettingServiceProvider extends ServiceProvider
{
    use AddsAsset, LoadsConfig;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('settings', SettingTabs::class);

        $this->addAssets('admin.settings.edit', ['admin.media.css', 'admin.media.js', 'admin.setting.js']);

        Validator::extend('redis', RedisValidator::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadConfigs(['assets.php', 'permissions.php']);
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
