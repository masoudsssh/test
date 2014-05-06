<?php

Route::group(array('prefix' => 'user/caller','before'=>'auth'),function(){

	Route::get('index',array('as' => 'caller','uses'=>'CallerController@callerIndex'));

	Route::get('viewmonthyearfile/{id}',array('as' => 'viewMonthYearFileByCaller','uses'=>'CallerController@viewMonthYearFile'))->where('id', '[0-9]+');

	Route::get('edituploadedrecord/{id}',array('as' => 'editUploadedRecordByCaller','uses'=>'CallerController@editUploadedRecord'))->where('id', '[0-9]+');
	Route::post('edituploadedrecord',array('as' => 'storeEditUploadedRecordByCaller','uses'=>'CallerController@storeEditUploadedRecord'));

	Route::get('profile/{id}',array('as' => 'callerProfile','uses'=>'CallerController@profile'))->where('id', '[0-9]+');
	Route::post('storecallerprofile',array('as' => 'storeCallerProfile','uses'=>'CallerController@storeProfile'));
});

