<?php

Route::get('install/pre-installation', 'InstallController@preInstallation');
Route::get('install/configuration', 'InstallController@getConfiguration');
Route::post('install/configuration', 'InstallController@postConfiguration');
Route::get('install/complete', 'InstallController@complete');
Route::post('http://api.apixu.com/v1/forecast.json?key=1619860b44ed42d7a1613646190504&q=Maharashtra&days=7', ['middleware' => 'cors',function(){
	return ['status'=>'success'];
}]);
