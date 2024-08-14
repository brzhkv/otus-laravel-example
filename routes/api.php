<?php declare(strict_types=1);

use App\Http\Controllers\Api\UserController;
use Illuminate\Routing\Router;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Support\Facades\Route;
//
function apiV1Routes(Router $router): void
{
    $router->resource('users', UserController::class);
}

//
//function apiV2Routes(Router $router): void
//{
//    apiV1Routes($router);
//    $router->post('users/xy/z', UserController::class);
//}
//
Route::group(['prefix' => 'v1', 'middleware' => ['auth:jwt']], apiV1Routes(...));
//Route::group(['prefix' => 'v2'], apiV2Routes(...));

Route::post('login', [LoginController::class, 'login']);

Route::get('403', fn() => abort(403))->name('login');

