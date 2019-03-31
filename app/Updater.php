<?php

namespace FleetCart;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class Updater
{
    public static function run()
    {
        self::cacheClear();
        self::viewClear();

        File::delete(storage_path('app/update'));
    }

    private static function cacheClear()
    {
        Artisan::call('cache:clear');
    }

    private static function viewClear()
    {
        Artisan::call('view:clear');
    }
}
