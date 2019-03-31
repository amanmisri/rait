<?php

namespace Modules\Setting\Listeners;

use Modules\Setting\Events\SettingSaved;

class ClearSettingsCache
{
    /**
     * Handle the event.
     *
     * @param \Modules\Setting\Events\SettingSaved $event
     * @return void
     */
    public function handle(SettingSaved $event)
    {
        $event->setting->clearCache();
    }
}
