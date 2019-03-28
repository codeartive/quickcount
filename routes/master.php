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
Route::get('/login',function(){
	return view('auth.login');
})->name('login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function(){
    	return redirect('dashboard');
    });
	
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	
	Route::prefix('master-data')->group(function () {
		Route::prefix('partai')->group(function () {
			Route::get('/', 'PartaiController@index')->name('view.partai');
			Route::post('/add', 'PartaiController@store')->name('add.partai');
			Route::get('/edit/{id}', 'PartaiController@edit')->name('update.partai');
			Route::post('/edit/{id}', 'PartaiController@update')->name('update.partai');
			Route::get('/delete/{id}', 'PartaiController@destroy')->name('delete.partai');
		});

		Route::prefix('calon-legislatif')->group(function () {
			Route::get('/', 'CalonLegislatifController@index')->name('view.calon-legislatif');
			Route::post('/add', 'CalonLegislatifController@store')->name('add.calon-legislatif');
			Route::get('/edit/{id}', 'CalonLegislatifController@edit')->name('update.calon-legislatif');
			Route::post('/edit/{id}', 'CalonLegislatifController@update')->name('update.calon-legislatif');
			Route::get('/delete/{id}', 'CalonLegislatifController@destroy')->name('delete.calon-legislatif');
		});

		Route::prefix('kecamatan')->group(function () {
			Route::get('/', 'KecamatanController@index')->name('view.kecamatan');
			Route::post('/add', 'KecamatanController@store')->name('add.kecamatan');
			Route::get('/edit/{id}', 'KecamatanController@edit')->name('update.kecamatan');
			Route::post('/edit/{id}', 'KecamatanController@update')->name('update.kecamatan');
			Route::get('/delete/{id}', 'KecamatanController@destroy')->name('delete.kecamatan');
		});

		Route::prefix('kelurahan')->group(function () {
			Route::get('/', 'KelurahanController@index')->name('view.kelurahan');
			Route::post('/add', 'KelurahanController@store')->name('add.kelurahan');
			Route::get('/edit/{id}', 'KelurahanController@edit')->name('update.kelurahan');
			Route::post('/edit/{id}', 'KelurahanController@update')->name('update.kelurahan');
			Route::get('/delete/{id}', 'KelurahanController@destroy')->name('delete.kelurahan');
		});

		Route::prefix('rw')->group(function () {
			Route::get('/', 'RukunWargaController@index')->name('view.rw');
			Route::post('/add', 'RukunWargaController@store')->name('add.rw');
			Route::get('/edit/{id}', 'RukunWargaController@edit')->name('update.rw');
			Route::post('/edit/{id}', 'RukunWargaController@update')->name('update.rw');
			Route::get('/delete/{id}', 'RukunWargaController@destroy')->name('delete.rw');
		});

		Route::prefix('rt')->group(function () {
			Route::get('/', 'RukunTetanggaController@index')->name('view.rt');
			Route::post('/add', 'RukunTetanggaController@store')->name('add.rt');
			Route::post('/edit/{id}', 'RukunTetanggaController@update')->name('update.rt');
			Route::get('/delete/{id}', 'RukunTetanggaController@destroy')->name('delete.rt');
		});

		Route::prefix('tps')->group(function () {
			Route::get('/', 'TPSController@index')->name('view.tps');
			Route::post('/add', 'TPSController@store')->name('add.tps');
			Route::get('/edit/{id}', 'TPSController@edit')->name('update.tps');
			Route::post('/edit/{id}', 'TPSController@update')->name('update.tps');
			Route::get('/delete/{id}', 'TPSController@destroy')->name('delete.tps');
		});

		Route::prefix('voting')->group(function () {
			Route::get('/', 'VotingController@index')->name('view.voting');
			Route::get('/add', 'VotingController@create')->name('add.voting');
			Route::post('/add', 'VotingController@store')->name('add.voting');
		});
	});

	Route::prefix('utilities')->group(function () {
		Route::get('/kecamatan','UtilitiesController@getDataKecamatan')->name('data.kecamatan');
		Route::get('/kelurahan/{parent_id?}','UtilitiesController@getDataKelurahan')->name('data.kelurahan');
		Route::get('/rukun-warga/{parent_id?}','UtilitiesController@getDataRukunWarga')->name('data.rukun-warga');
		Route::get('/rukun-tetangga/{parent_id?}','UtilitiesController@getDataRukunTetangga')->name('data.rukun-tetangga');
		Route::get('/tps/{parent_id?}','UtilitiesController@getDataTPS')->name('data.tps');
		Route::get('/tps/filtered/{parent_id?}','UtilitiesController@getDataTPSFiltered')->name('data.tps.filtered');
		Route::post('/voting','UtilitiesController@getDataVoting')->name('data.voting');
		Route::get('/partai','UtilitiesController@getDataPartai')->name('data.partai');
	});
});
