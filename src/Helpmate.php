<?php

namespace Laramin\Utility;

use App\Models\GeneralSetting;

class Helpmate{
    public static function sysPass(){
        $fileExists = file_exists(__DIR__.'/laramin.json');
        $general = cache()->get('GeneralSetting');
        if (!$general) {
            $general = GeneralSetting::first();
        }
        if (!$fileExists || $general->maintenance_mode == 9 || !env('PURCHASECODE')) {
            return false;
        }

        return true;

    }

    public static function appUrl(){
        $current = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $url = substr($current, 0, -9);
        return  $url;
    }
}

