<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($code = 200, $data = [], $msg = 'ok') {
            $content = array(
                'code' => $code,
                'data' => $data ?: (object)[],
                'msg' => $msg
            );
            return response()->json($content);
        });

        Response::macro('error', function ($code = 40000, $msg = '请求失败', $data = []) {
            $content = array(
                'code' => $code,
                'data' => $data ?: (object)[],
                'msg' => $msg
            );
            return response()->json($content);
        });
    }
}
