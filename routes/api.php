<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//上传文件demo到阿里OSS
Route::post('/upload', function (Request $request) {
    if (!$request->hasFile('photo')) {
        return response()->error(...error_msg(40001));
    }
    $savePath = 'images';
    $filePath = $request->photo->path();
    $extension = $request->photo->extension();
    if (!in_array($extension, array('jpeg', 'png'))) {
        return response()->error(...error_msg(40007));
    }
    $fileName = md5(uniqid("", true) . rand(100000, 666666)) . '.' . $extension;
    $content = file_get_contents($filePath);
    $saveName = $savePath . '/' . $fileName;
    \App\Services\OSS::publicUploadContent('chaoshigouwu', $saveName, $content);
    $data = array(
        'url' => env('ALI_OSS_HOST') . '/' . $saveName,
        'path' => '/' . $saveName
    );
    return response()->success(200, $data);
});

Route::get('/queue', function () {
    \App\Jobs\TestQueue::dispatch(1);
});

