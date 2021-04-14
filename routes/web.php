<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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

Route::get('/admin', 'App\Http\Controllers\AdminController@loginAdmin');
Route::post('/admin', 'App\Http\Controllers\AdminController@processLoginAdmin');

Route::get('/home', function () {
    return view('home');
});


Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\CategoryController@index',
            'middleware'=>'can:read-category',
        ]);
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\CategoryController@create',
            'middleware'=>'can:create-category',
        ]);
        Route::post('/store', [
            'as' => 'categories.store',
            'uses' => 'App\Http\Controllers\CategoryController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'middleware'=>'can:update-category',
            'uses' => 'App\Http\Controllers\CategoryController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\CategoryController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\CategoryController@delete',
            'middleware'=>'can:delete-category',
        ]);
    });
    Route::prefix('menus')->group(function(){
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'App\Http\Controllers\MenuController@index',
            'middleware'=>'can:read-menu',
        ]);
        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'App\Http\Controllers\MenuController@create',
            'middleware'=>'can:create-menu',
        ]);
        Route::post('/store', [
            'as' => 'menus.store',
            'uses' => 'App\Http\Controllers\MenuController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit',
            'middleware'=>'can:update-menu',

        ]);
        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'App\Http\Controllers\MenuController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'App\Http\Controllers\MenuController@delete',
            'middleware'=>'can:delete-menu',
        ]);
    });
    Route::prefix('products')->group(function(){
        Route::get('/', [
            'as' => 'products.index',
            'uses' => 'App\Http\Controllers\AdminProductController@index',
            'middleware'=>'can:read-product',
        ]);
        Route::get('/create', [
            'as' => 'products.create',
            'middleware'=>'can:create-product',
            'uses' => 'App\Http\Controllers\AdminProductController@create'
        ]);
        Route::post('/store', [
            'as' => 'products.store',
            'uses' => 'App\Http\Controllers\AdminProductController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'products.edit',
            'middleware'=>'can:update-product',
            'uses' => 'App\Http\Controllers\AdminProductController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'products.update',
            'uses' => 'App\Http\Controllers\AdminProductController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'products.delete',
            'middleware'=>'can:delete-product',
            'uses' => 'App\Http\Controllers\AdminProductController@delete'
        ]);
    });
    Route::prefix('sliders')->group(function(){
        Route::get('/', [
            'as' => 'sliders.index',
            'middleware'=>'can:read-slider',
            'uses' => 'App\Http\Controllers\AdminSliderController@index'
        ]);
        Route::get('/create', [
            'as' => 'sliders.create',
            'middleware'=>'can:create-slider',
            'uses' => 'App\Http\Controllers\AdminSliderController@create'
        ]);
        Route::post('/store', [
            'as' => 'sliders.store',
            'uses' => 'App\Http\Controllers\AdminSliderController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'sliders.edit',
            'middleware'=>'can:update-slider',
            'uses' => 'App\Http\Controllers\AdminSliderController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'sliders.update',
            'uses' => 'App\Http\Controllers\AdminSliderController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'sliders.delete',
            'middleware'=>'can:delete-slider',
            'uses' => 'App\Http\Controllers\AdminSliderController@delete'
        ]);
    });
    Route::prefix('settings')->group(function(){
        Route::get('/', [
            'as' => 'settings.index',
            'middleware'=>'can:read-setting',
            'uses' => 'App\Http\Controllers\AdminSettingController@index'
        ]);
        Route::get('/create', [
            'as' => 'settings.create',
            'middleware'=>'can:create-setting',
            'uses' => 'App\Http\Controllers\AdminSettingController@create'
        ]);
        Route::post('/store', [
            'as' => 'settings.store',
            'uses' => 'App\Http\Controllers\AdminSettingController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'settings.edit',
            'middleware'=>'can:update-setting',
            'uses' => 'App\Http\Controllers\AdminSettingController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'settings.update',
            'uses' => 'App\Http\Controllers\AdminSettingController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'settings.delete',
            'middleware'=>'can:delete-setting',
            'uses' => 'App\Http\Controllers\AdminSettingController@delete'
        ]);
    });
    Route::prefix('users')->group(function(){
        Route::get('/', [
            'as' => 'users.index',
            'middleware'=>'can:read-user',
            'uses' => 'App\Http\Controllers\AdminUserController@index'
        ]);
        Route::get('/create', [
            'as' => 'users.create',
            'middleware'=>'can:create-user',
            'uses' => 'App\Http\Controllers\AdminUserController@create'
        ]);
        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'App\Http\Controllers\AdminUserController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'middleware'=>'can:update-user',
            'uses' => 'App\Http\Controllers\AdminUserController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'App\Http\Controllers\AdminUserController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'middleware'=>'can:delete-user',
            'uses' => 'App\Http\Controllers\AdminUserController@delete'
        ]);
    });
    Route::prefix('roles')->group(function(){
        Route::get('/', [
            'as' => 'roles.index',
            'middleware'=>'can:read-role',
            'uses' => 'App\Http\Controllers\AdminRoleController@index'
        ]);
        Route::get('/create', [
            'as' => 'roles.create',
            'middleware'=>'can:create-role',
            'uses' => 'App\Http\Controllers\AdminRoleController@create'
        ]);
        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'App\Http\Controllers\AdminRoleController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'roles.edit',
            'middleware'=>'can:update-role',
            'uses' => 'App\Http\Controllers\AdminRoleController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'App\Http\Controllers\AdminRoleController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'roles.delete',
            'middleware'=>'can:delete-role',
            'uses' => 'App\Http\Controllers\AdminRoleController@delete'
        ]);
    });
    Route::prefix('permissions')->group(function(){
        // Route::get('/', [
        //     'as' => 'permissions.index',
        //     'uses' => 'App\Http\Controllers\AdminPermissionController@index'
        // ]);
        Route::get('/create', [
            'as' => 'permissions.create',
            'uses' => 'App\Http\Controllers\AdminPermissionController@create'
        ]);
        Route::post('/store', [
            'as' => 'permissions.store',
            'uses' => 'App\Http\Controllers\AdminPermissionController@store'
        ]);
        // Route::get('/edit/{id}', [
        //     'as' => 'permissions.edit',
        //     'uses' => 'App\Http\Controllers\AdminPermissionController@edit'
        // ]);
        // Route::post('/update/{id}', [
        //     'as' => 'permissions.update',
        //     'uses' => 'App\Http\Controllers\AdminPermissionController@update'
        // ]);
        // Route::get('/delete/{id}', [
        //     'as' => 'permissions.delete',
        //     'uses' => 'App\Http\Controllers\AdminPermissionController@delete'
        // ]);
    });
});
Route::prefix('customer')->group(function(){

});
//    Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });
