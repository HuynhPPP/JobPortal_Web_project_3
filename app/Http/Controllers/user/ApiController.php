<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function getProvinces()
    {
        $response = Http::get("https://esgoo.net/api-tinhthanh/1/0.htm");
        return $response->json();
    }

    public function getDistricts($provinceId)
    {
        $response = Http::get("https://esgoo.net/api-tinhthanh/2/{$provinceId}.htm");
        return $response->json();
    }

    public function getWards($districtId)
    {
        $response = Http::get("https://esgoo.net/api-tinhthanh/3/{$districtId}.htm");
        return $response->json();
    }
}
