<?php

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function(){
    Route::get('/', 'DashboardController');

    Route::resource('/uangmasuk', 'UangMasukController', [
        'except' => ['show']
    ]) ;
    Route::get('/uangmasuk/print', 'UangMasukController@print')->name('uangmasuk.print') ;
    Route::post('/uangmasuk/print/pdf', 'UangMasukController@pdf')->name('uangmasuk.print.pdf') ;

    Route::resource('/uangkeluar', 'UangKeluarController', [
        'except' => ['show']
    ]) ;
    Route::get('/uangkeluar/print', 'UangKeluarController@print')->name('uangkeluar.print') ;
    Route::post('/uangkeluar/print/pdf', 'UangKeluarController@pdf')->name('uangkeluar.print.pdf') ;

    Route::resource('/kajian', 'KajianController', [
        'except' => ['show']
    ]) ;
    Route::get('/kajian/print', 'KajianController@print')->name('kajian.print') ;
    Route::post('/kajian/print/pdf', 'KajianController@pdf')->name('kajian.print.pdf') ;

    Route::resource('kegiatan', 'KegiatanController', [
        'except' => ['show']
    ]) ;
    Route::get('/kegiatan/print', 'KegiatanController@print')->name('kegiatan.print') ;
    Route::post('/kegiatan/print/pdf', 'KegiatanController@pdf')->name('kegiatan.print.pdf') ;


}) ;
