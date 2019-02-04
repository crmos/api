<?php
/**
 * Created by PhpStorm.
 * User: Saurav KC
 * Date: 2/1/2019
 * Time: 5:10 PM
 */

Route::group(['namespace' => 'General'], function () {
    Route::get('home', 'HomeController@index')->name('home.index');
});
