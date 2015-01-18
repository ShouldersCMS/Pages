<?php 
Route::get('admin/pages/create', 'Shoulderscms\Pages\Controllers\PagesController@create');
Route::any('admin/pages/store', 'Shoulderscms\Pages\Controllers\PagesController@store');
Route::get('admin/pages', 'Shoulderscms\Pages\Controllers\PagesController@index');
Route::get('admin/pages/edit/{id}', 'Shoulderscms\Pages\Controllers\PagesController@edit');
Route::any('admin/pages/update/{id}', 'Shoulderscms\Pages\Controllers\PagesController@update');

Menu::get('AdminNav')->add('Pages', array('url' => 'admin/pages', 'icon' => 'fa fa-file-o', 'class' => 'test'))->data('order', 10);
Menu::get('AdminNav')->pages->add('Create Page', 'admin/pages/create');
Menu::get('AdminNav')->pages->add('Manage Pages', 'admin/pages');