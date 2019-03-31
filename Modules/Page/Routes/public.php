<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('{slug}', 'PageController@show');
