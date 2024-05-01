<?php

namespace Laramin\Utility;

use App\Lib\CurlRequest;
use App\Models\GeneralSetting;

class Onumoti{

    public static function getData(){
        $param['purchasecode'] = env("PURCHASECODE");
        $param['website'] = @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'] . ' - ' . env("APP_URL");
        $reqRoute = VugiChugi::lcLabRoute();
        $reqRoute = $reqRoute. systemDetails()['name'];
        $response = CurlRequest::curlPostContent($reqRoute, $param);

        $response = json_decode($response);
        if (!$response) {
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'error'=>'Something went wrong'
            ]);
            throw $error;
        }
        $general = GeneralSetting::first();
        if (@$response->mm) {
            $general->maintenance_mode = $response->mm;
        }
        if ($general->getAttribute('available_version') !== null) {
            $general->available_version = $response->version;
        }
        $general->save();
    }

    public static function mySite($site,$className){
        $myClass = VugiChugi::clsNm();
        if($myClass != $className){
            return $site->middleware(VugiChugi::mdNm());
        }
    }
}
