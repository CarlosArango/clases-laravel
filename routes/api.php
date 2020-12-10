<?php

use App\Http\Controllers\ThirdAuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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


Route::get("posts", function () {
    $response = Http::get('https://jsonplaceholder.typicode.com/posts');
    return $response;
});


Route::get("users", function () {
    $users = Http::get('https://jsonplaceholder.typicode.com/users');

    $thirdAuthControler = new  ThirdAuthenticationController();
    $authentication = $thirdAuthControler->getAuthenticationByClient("gatorade");
    if (!$authentication) {
        $thirdAuthControler->requestAuthenticationTokenToGatorade();
        $thirdAuthControler->getAuthenticationByClient("gatorade");
    }
    return "Existe";
    return $authentication;
});