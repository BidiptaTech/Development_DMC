<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
class CommonHelper
{
    /*
    * Get User Data Based on IP Address .
    * Date 14-10-2024
    */
    public static function getCountryInfo($ipAddress)
    {
        $response = Http::get("https://ipapi.co/{$ipAddress}/json/");
        $data = $response->json();
        return [
            'country_code' => $data['country_calling_code'] ?? 'Unknown',
            'country_name' => $data['country_name'] ?? 'Unknown',
        ];
    }

    /*
    * Access Master Value .
    * Date 18-10-2024
    */
    public static function masterSettingsName($name) {
        $setting = Setting::where('name', $name)->first();
        if ($setting) {
            return [
                'master_value' => $setting->value,
            ];
        }
        return [
            'master_value' => null,
        ];
    }

    /*
    * Image path set.
    * Date 14-11-2024
    */
    public static function image_path($name, $logoFile) {
        $get_filestorage = Setting::where('name', $name)->where('status', 1)->first();
        $logoName = 'logo_' . time() . '.' . $logoFile->getClientOriginalExtension();
        
        if ($get_filestorage) {
            if ($get_filestorage->value == 'local') {
                $destinationPath = public_path('build/images');
                $logoFile->move($destinationPath, $logoName);
                $logoPath = asset('build/images/' . $logoName);
            } elseif ($get_filestorage->value == 's3') {
                $logoPath = Storage::disk('s3')->url(Storage::disk('s3')->putFileAs('uploads', $logoFile, $logoName));
            } elseif ($get_filestorage->value == 'azure') {
                $logoPath = Storage::disk('azure')->url(Storage::disk('azure')->putFileAs('uploads', $logoFile, $logoName));
            }
            return [
                'master_value' => $logoPath,
            ];
        }
        return [
            'master_value' => null,
        ];
    }
    
}
