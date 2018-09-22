<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', function () {
    return redirect('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', function() {
        return view('dashboard');
    });

    Route::get('stats', 'HomeController@index');

    // Route::group(['middleware' => ['role:superadministrator|administrator']], function () {
        Route::resource('users', 'UserController');

        Route::resource('profiles', 'ProfileController');

        Route::resource('roles', 'RoleController');

        Route::resource('permissions', 'PermissionController');

        Route::resource('settings', 'SettingController');
    // });
});

Route::get('/img/{path}', function(Filesystem $filesystem, $path) {
    $server = ServerFactory::create([
        'response' => new LaravelResponseFactory(app('request')),
        'source' => $filesystem->getDriver(),
        'cache' => $filesystem->getDriver(),
        'cache_path_prefix' => '.cache',
        'base_url' => 'img',
    ]);

    return $server->getImageResponse($path, request()->all());
})->where('path', '.*');

Route::get('admin/pages', ['as'=> 'admin.pages.index', 'uses' => 'Admin\PageController@index']);
Route::post('admin/pages', ['as'=> 'admin.pages.store', 'uses' => 'Admin\PageController@store']);
Route::get('admin/pages/create', ['as'=> 'admin.pages.create', 'uses' => 'Admin\PageController@create']);
Route::put('admin/pages/{pages}', ['as'=> 'admin.pages.update', 'uses' => 'Admin\PageController@update']);
Route::patch('admin/pages/{pages}', ['as'=> 'admin.pages.update', 'uses' => 'Admin\PageController@update']);
Route::delete('admin/pages/{pages}', ['as'=> 'admin.pages.destroy', 'uses' => 'Admin\PageController@destroy']);
Route::get('admin/pages/{pages}', ['as'=> 'admin.pages.show', 'uses' => 'Admin\PageController@show']);
Route::get('admin/pages/{pages}/edit', ['as'=> 'admin.pages.edit', 'uses' => 'Admin\PageController@edit']);
// Route::post('importPage', 'Admin\PageController@import');

Route::get('admin/pages', ['as'=> 'admin.pages.index', 'uses' => 'Admin\PageController@index']);
Route::post('admin/pages', ['as'=> 'admin.pages.store', 'uses' => 'Admin\PageController@store']);
Route::get('admin/pages/create', ['as'=> 'admin.pages.create', 'uses' => 'Admin\PageController@create']);
Route::put('admin/pages/{pages}', ['as'=> 'admin.pages.update', 'uses' => 'Admin\PageController@update']);
Route::patch('admin/pages/{pages}', ['as'=> 'admin.pages.update', 'uses' => 'Admin\PageController@update']);
Route::delete('admin/pages/{pages}', ['as'=> 'admin.pages.destroy', 'uses' => 'Admin\PageController@destroy']);
Route::get('admin/pages/{pages}', ['as'=> 'admin.pages.show', 'uses' => 'Admin\PageController@show']);
Route::get('admin/pages/{pages}/edit', ['as'=> 'admin.pages.edit', 'uses' => 'Admin\PageController@edit']);
// Route::post('importPage', 'Admin\PageController@import');

Route::get('admin/pages', ['as'=> 'admin.pages.index', 'uses' => 'Admin\PageController@index']);
Route::post('admin/pages', ['as'=> 'admin.pages.store', 'uses' => 'Admin\PageController@store']);
Route::get('admin/pages/create', ['as'=> 'admin.pages.create', 'uses' => 'Admin\PageController@create']);
Route::put('admin/pages/{pages}', ['as'=> 'admin.pages.update', 'uses' => 'Admin\PageController@update']);
Route::patch('admin/pages/{pages}', ['as'=> 'admin.pages.update', 'uses' => 'Admin\PageController@update']);
Route::delete('admin/pages/{pages}', ['as'=> 'admin.pages.destroy', 'uses' => 'Admin\PageController@destroy']);
Route::get('admin/pages/{pages}', ['as'=> 'admin.pages.show', 'uses' => 'Admin\PageController@show']);
Route::get('admin/pages/{pages}/edit', ['as'=> 'admin.pages.edit', 'uses' => 'Admin\PageController@edit']);
// Route::post('importPage', 'Admin\PageController@import');

Route::resource('makans', 'MakanController');
// Route::post('importMakan', 'MakanController@import');

Route::resource('minumen', 'MinumanController');
// Route::post('importMinuman', 'MinumanController@import');

Route::get('admin/testlagis', ['as'=> 'admin.testlagis.index', 'uses' => 'Admin\TestlagiController@index']);
Route::post('admin/testlagis', ['as'=> 'admin.testlagis.store', 'uses' => 'Admin\TestlagiController@store']);
Route::get('admin/testlagis/create', ['as'=> 'admin.testlagis.create', 'uses' => 'Admin\TestlagiController@create']);
Route::put('admin/testlagis/{testlagis}', ['as'=> 'admin.testlagis.update', 'uses' => 'Admin\TestlagiController@update']);
Route::patch('admin/testlagis/{testlagis}', ['as'=> 'admin.testlagis.update', 'uses' => 'Admin\TestlagiController@update']);
Route::delete('admin/testlagis/{testlagis}', ['as'=> 'admin.testlagis.destroy', 'uses' => 'Admin\TestlagiController@destroy']);
Route::get('admin/testlagis/{testlagis}', ['as'=> 'admin.testlagis.show', 'uses' => 'Admin\TestlagiController@show']);
Route::get('admin/testlagis/{testlagis}/edit', ['as'=> 'admin.testlagis.edit', 'uses' => 'Admin\TestlagiController@edit']);
// Route::post('importTestlagi', 'Admin\TestlagiController@import');