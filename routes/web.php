<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as Dashboard;
use App\Http\Controllers\Admin\SliderController as Slider;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$prefixAdmin = config('utils.url.prefix_admin');
Route::group(['prefix' => $prefixAdmin], function () {
    //    Dashboard Controller
    $prefix = 'dashboard';
    Route::get($prefix, [Dashboard::class, 'index'])->name($prefix);

    //    Slider Controller
    $prefix = 'slider';
    Route::group(['prefix' => $prefix], function () use($prefix){
        Route::get('/', [Slider::class, 'index'])->name($prefix);
        Route::get('form/{id?}', [Slider::class, 'form'])
            ->name($prefix.'/form')->where('id','[0-9]+');
        Route::post('save', [Slider::class, 'save'])
            ->name($prefix.'/save');
        Route::post('delete', [Slider::class, 'delete'])
            ->name($prefix.'/delete');
    });


});

