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
            if (is_array($code)) {
                $data = $code;
                $code = 200;
            }
            $content = array(
                'code' => $code,
                'msg' => $msg,
                'data' => $data ?: (object)[]
            );
            return response()->json($content);
        });

        Response::macro('error', function ($code = 40000, $msg = '请求失败', $data = []) {
            $content = array(
                'code' => $code,
                'msg' => $msg,
                'data' => $data ?: (object)[]

            );
            return response()->json($content);
        });
    }
}
