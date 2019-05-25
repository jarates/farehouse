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

Route::get('/', 'SettingController@supplier');

Route::get('/genpass', function () {
    $password = 'admin@2';
    echo password_hash($password, PASSWORD_DEFAULT);
});

Route::group(['middleware' => 'afterUserLogin'], function(){

	Route::get('/login', 'AuthenticationController@showLogin');
	Route::post('/login', 'AuthenticationController@doLogin');

});

Route::group(['middleware' => 'admin'], function(){

	Route::get('/setting/company', 'SettingController@company');
	Route::post('/setting/company/save', 'SettingController@saveCompany');
	Route::get('/setting/supplier', 'SettingController@supplier');
	Route::post('/setting/supplier/save', 'SettingController@saveSupplier');
	Route::post('/setting/supplier/edit', 'SettingController@editSupplier');
	Route::post('/setting/supplier/del', 'SettingController@delSupplier');
	Route::get('/logout', 'AuthenticationController@doLogout');

	Route::get('/setting/type-product', 'SettingController@typeProduct');
	Route::post('/setting/type-product/save', 'SettingController@saveTypeProduct');


	Route::get('/setting/category-product', 'SettingController@categoryProduct');
	Route::post('/setting/category-product/save', 'SettingController@saveCategoryProduct');

	Route::get('/setting/brand-product', 'SettingController@brandProduct');
	Route::post('/setting/brand-product/save', 'SettingController@saveBrandProductt');

	//ajax onchange
	Route::post('/province/get_amphur_by_province', 'ProvinceController@ajaxGetAmphurByProvince');
	Route::post('/province/get_district_by_amphur', 'ProvinceController@ajaxGetDistrictByAmphur');

	//product
	Route::get('/product/create', 'ProductController@create');
	Route::get('/product/management', 'ProductController@management');
	Route::get('/product/edit/{product_id}', 'ProductController@edit');
	Route::post('/product/save', 'ProductController@save');
	Route::post('/product/picture/save', 'ProductpictureController@saveProductpicture');
	Route::post('/product/picture/uploadPreview', 'ProductpictureController@uploadPreview');
	Route::post('/product/picture/delUploadPreview', 'ProductpictureController@delUploadPreview');

	//รับเข้าสินค้า
	
	Route::get('/product/acceptance', 'ProductController@productAcceptance');
	Route::get('/product/acceptance/list', 'ProductController@listProductAcceptance');
	Route::get('/product/acceptance/edit/{acceptance_id}', 'ProductController@editProductAcceptance');
	Route::post('/product/acceptance-import-list-product', 'ProductController@productAcceptanceImportList');
	Route::post('/product/acceptance-import-list-product/save', 'ProductController@saveProductAcceptanceImportList');

});
