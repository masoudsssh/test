<?php

//Route::get('/',array('as' => 'clientIndex','uses' => 'ClientController@clientIndex'));


Route::get('/',array('as' => 'loginForm','uses'=>'AuthController@loginForm'));

Route::post('/login',array('as' => 'loginPost','uses'=>'AuthController@login'));

Route::get('logout',array('as' => 'logout','uses'=>'AuthController@logout'));


route::group(array('prefix' => 'user','before'=>'auth|admin'),function(){

	Route::get('admin',array('as' => 'clientAdmin','uses'=>'ClientController@clientIndex'));

	Route::get('viewFiles',array('as' => 'viewFiles','uses'=>'ClientController@viewFiles'));

	Route::get('readExcelFile',array('as' => 'readExcelFile','uses'=>'ClientController@readExcelFile'));

	Route::get('importFile',array('as' => 'importFile','uses'=>'ClientController@importFile'));
	Route::post('importFile',array('as' => 'storeFileIntoDB','uses'=>'ClientController@storeFileIntoDB'));

	Route::get('confirmuploadedfile/{id}',array('as' => 'confirmUploadedFile','uses'=>'ClientController@confirmUploadedFile'))->where('id', '[0-9]+');
	
	Route::get('viewduplicatedfiles',array('as' => 'viewDuplicatedFiles','uses'=>'ClientController@viewDuplicatedFiles'));
	Route::get('viewduplicatedfile/{id}',array('as' => 'viewDuplicatedFile','uses'=>'ClientController@viewDuplicatedFile'))->where('id', '[0-9]+');	

	Route::get('viewmonthyearfiles',array('as' => 'viewMonthYearFiles','uses'=>'ClientController@viewMonthYearFiles'));
	Route::get('viewmonthyearfile/{id}',array('as' => 'viewMonthYearFile','uses'=>'ClientController@viewMonthYearFile'))->where('id', '[0-9]+');
	Route::get('confirmmonthyearfile/{id}',array('as' => 'confirmMonthYearFile','uses'=>'ClientController@confirmMonthYearFile'))->where('id', '[0-9]+');
	Route::get('viewMasterFiles',array('as' => 'viewMasterFiles','uses'=>'ClientController@viewMasterFiles'));
	Route::get('viewMasterWeeksFile/{id}',array('as' => 'viewMasterWeeksFile','uses'=>'ClientController@viewMasterWeeksFile'))->where('id', '[0-9]+');

	Route::get('confirmAllWeeksAsMonthBatch/{id}',array('as' => 'confirmAllWeeksAsMonthBatch','uses'=>'ClientController@confirmAllWeeksAsMonthBatch'))->where('id', '[0-9]+');

	Route::get('edituploadedrecord/{id}',array('as' => 'editUploadedRecord','uses'=>'ClientController@editUploadedRecord'))->where('id', '[0-9]+');


		Route::get('create',array('as' => 'newuser' , 'uses' => 'UsersController@newuser'));
		Route::post('create',array('as' => 'newuserPost' , 'uses' => 'UsersController@storeNewUser'));
		Route::get('view',array('as' => 'viewusers', 'uses' => 'UsersController@viewUsers'));
		Route::post('updatepassword',array('as' => 'updatePassword', 'uses' => 'UsersController@updatePassword'));
		Route::post('deleteuser',array('as' => 'deleteUser', 'uses' => 'UsersController@deleteUser'));

	Route::get('viewExportFile',array('as' => 'viewExportFile','uses'=>'ClientController@viewExportFile'));
	Route::get('exportFile/{id}',array('as' => 'exportFile','uses'=>'ClientController@exportFile'))->where('id', '[0-9]+');

});

