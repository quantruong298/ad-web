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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/test', function () {
//    return Excel::download(new \App\Exports\ReportsExport(), 'export.xlsx');
//});

Route::get('/activate', 'Auth\RegisterController@updateStatus');

//USER ROUTES
Route::get('/user', 'UserController@index')->name('user');

Route::delete('/user/delete', 'UserController@deleteUser')->name('user.delete');

Route::post('/user/store', 'UserController@storeUser')->name('user.store');

Route::put('/user/update', 'UserController@updateUser')->name('user.update');

Route::get('/user/get-info-user-by-id', 'UserController@getInfoUserById');


Auth::routes();
//HOME ROUTES
Route::get('/', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/product_items/{catid}', 'HomeController@getProducts');
Route::get('/home-product/{pid}', 'HomeController@show')->name('product.show');
Route::get('/catalog_items', 'HomeController@getAllCatalog');
Route::get('/cat', 'HomeController@getProductsByCatId');

//CATALOG ROUTES
Route::get('/catalog', 'CatalogController@index')->name('catalog.index');
Route::get('/catalog/create', 'CatalogController@create')->name('catalog.create');
Route::post('/catalog', 'CatalogController@store')->name('catalog.store');
Route::get('/catalog/{cid}', 'CatalogController@show')->name('catalog.show');
Route::get('/catalog/{cid}/edit', 'CatalogController@edit')->name('catalog.edit');
Route::put('/catalog/{cid}', 'CatalogController@update')->name('catalog.update');
Route::delete('/catalog/{cid}', 'CatalogController@destroy')->name('catalog.destroy');


//PRODUCT ROUTES
Route::get('/product', 'ProductController@index')->name('product.index');
Route::get('/product/backup', 'ProductController@backup')->name('product.backup');
Route::get('/product/search', 'ProductController@search')->name('product.search');
Route::get('/product/create', 'ProductController@create')->name('product.create');
Route::post('/product', 'ProductController@store')->name('product.store');
//Route::get('/product/{pid}', 'ProductController@show')->name('product.show');
Route::get('/product/{pid}/edit', 'ProductController@edit')->name('product.edit');
Route::post('/product/update', 'ProductController@update')->name('product.update');
Route::delete('/product/{pid}', 'ProductController@destroy')->name('product.destroy');


//CAMPAIGN ROUTES
Route::get('/campaign', 'CampaignController@index')->name('campaign.index');
Route::post('/campaign/store', 'CampaignController@storeCampaign')->name('campaign.store');
Route::get('/campaign/get-info-campaign-by-id', 'CampaignController@getInfoCampaignById');
Route::post('/campaign/{id}', 'CampaignController@updateCampaign')->name('campaign.update');
Route::delete('/campaign/{id}', 'CampaignController@deleteCampaign')->name('campaign.delete');


//REPORT ROUTES
Route::get('/report', 'ReportController@index')->name('report.index');
Route::get('/report/activec', 'ReportController@activec')->name('report.activec');
Route::get('/report/search', 'ReportController@search')->name('report.search');
Route::get('/report/export', 'ReportController@export')->name('report.export');
Route::get('/report/create', 'ReportController@create')->name('report.create');
Route::post('/report', 'ReportController@store')->name('report.store');
Route::get('/report/{id}', 'ReportController@show')->name('report.show');
Route::get('/report/{id}/edit', 'ReportController@edit')->name('report.edit');
Route::put('/report/{id}', 'ReportController@update')->name('report.update');
Route::delete('/report/{id}', 'ReportController@destroy')->name('report.destroy');

//CAMPAIGN DEATAIL ROUTES
Route::post('/campaign-detail/click', 'CampaignDetailController@click');
Route::post('/campaign-detail/view', 'CampaignDetailController@view');
