<?php

Route::get('/test',[
    'as'=>'module.test',
    'uses' => 'Lara\Cart\Http\Controllers\CartController@index'
]);