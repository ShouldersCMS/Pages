<?php
// Route::get('admin/pages/settings', 'Shoulderscms\Pages\Controllers\PagesController@settings');
Route::get('/', [
    'as' => 'home',
    'uses' => 'Shoulderscms\Pages\Controllers\PagesController@home'
]);
Route::resource('admin/pages', 'Shoulderscms\Pages\Controllers\PagesController');

Route::get('page/{slug}', 'Shoulderscms\Pages\Controllers\PagesController@show');

Menu::get('AdminNav')->add('Pages', array('url' => 'admin/pages', 'icon' => 'fa fa-file-o', 'class' => 'test'))->data('order', 10);
Menu::get('AdminNav')->pages->add('Create Page', 'admin/pages/create');
Menu::get('AdminNav')->pages->add('Manage Pages', 'admin/pages');
Menu::get('AdminNav')->pages->add('Pages Settings', 'admin/pages/settings');
