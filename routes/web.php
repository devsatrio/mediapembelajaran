<?php
use Illuminate\Support\Facades\Route;
Route::get('/','frontend\HomeController@index');
Route::get('/media-pembelajaran/{slug}','frontend\HomeController@tampilmedia');
Route::get('/view-media/{slug}','frontend\HomeController@tampillistkonten');
Route::get('/view-media/show/{slug}','frontend\HomeController@tampilkonten');

//----------------------------------------------------------------------------------------
Auth::routes();
Route::get('/home', 'backend\HomeController@index')->name('home');
Route::get('/edit-profile', 'backend\HomeController@editprofile')->name('editprofile');
Route::post('/edit-profile/{id}', 'backend\HomeController@aksieditprofile');

//----------------------------------------------------------------------------------------
// Route::get('/data-admin','backend\AdminController@listdata'); with datatable plugin
Route::resource('/admin','backend\AdminController');
Route::resource('/menu','backend\MenuController');
Route::resource('/halaman','backend\HalamanController');
Route::resource('/galeri','backend\GaleriController');
Route::resource('/submenu','backend\SubmenuController');
Route::resource('/kategori-artikel','backend\KategoriartikelController');
Route::resource('/artikel','backend\ArtikelController');
Route::resource('/komentar','backend\KomenartikelController');
Route::resource('/slider','backend\SliderController');
Route::resource('/setting-web','backend\SettingwebController');

//----------------------------------------------------------------------------------------
Route::get('edit-konten/{kode}','backend\KontenhalamanController@editkonten');
Route::put('edit-konten/{kode}','backend\KontenhalamanController@updatekonten');
Route::get('manage-halaman/{kode}','backend\KontenhalamanController@index');
Route::post('manage-halaman/tambah','backend\KontenhalamanController@createtunggal');
Route::post('manage-halaman/tambah-majemuk','backend\KontenhalamanController@storemajemuk');
Route::put('manage-halaman/{kode}','backend\KontenhalamanController@updatetunggal');
Route::get('manage-halaman/downloadqr/{slug}','backend\HalamanController@downloadqr');
Route::get('manage-halaman/downloadkontenqr/{slug}','backend\HalamanController@downloadkontenqrs');

//----------------------------------------------------------------------------------------
Route::get('manage-halaman-majemuk/{kode}','backend\KontenhalamanController@createmajemuk');
Route::get('hapus-konten/{kode}/{halaman}','backend\KontenhalamanController@hapuskonten');