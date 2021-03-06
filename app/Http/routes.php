<?php

Route::get('/', ['middleware' => 'guest', function () {
    return view('welcome');
}]);

Route::get('/', ['as' => 'home_path', 'uses' => 'UsersController@getDashboard', 'middleware' => 'auth']);

Route::get('dashboard', ['as' => 'dashboard_path', 'uses' => 'UsersController@getDashboard', 'middleware' => ['auth']]);
Route::get('blog', 'ArticlesController@getBlogPosts');
Route::get('status', ['as' => 'write_status_path', 'uses' => 'StatusesController@getWriteStatus', 'middleware' => 'auth']);
Route::post('status', ['as' => 'save_status_path', 'uses' => 'StatusesController@postSaveStatus', 'middleware' => 'auth']);
Route::get('roles', ['as' => 'my_roles_path', 'uses' => 'UsersController@getMyRoles', 'middleware' => ['auth']]);
Route::get('permissions', ['as' => 'my_permissions_path', 'uses' => 'UsersController@getMyPermissions', 'middleware' => ['auth']]);

Route::get('users', ['as' => 'all_users_path', 'uses' => 'UsersController@getAllUsersWithProfiles']);
Route::get('users/add', ['as' => 'add_user_path', 'uses' => 'UMSController@getAddUser', 'middleware' => ['auth', 'admin']]);
Route::get('users/roles', ['as' => 'all_roles_path', 'uses' => 'UMSController@getAllRoles', 'middleware' => ['auth', 'admin']]);
Route::get('users/permissions', ['as' => 'all_permissions_path', 'uses' => 'UMSController@getAllPermissions', 'middleware' => ['auth', 'admin']]);
Route::get('@{username}', ['as' => 'individual_user_statuses_path', 'uses' => 'UsersController@getIndividualUserStatuses', 'middleware' => ['auth']]);
Route::post('@{username}/add', ['as' => 'add_user_as_friend_path', 'uses' => 'UsersController@postAddUserAsFriend', 'middleware' => ['auth']]);

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('{username}', ['as' => 'profile_path', 'uses' => 'UsersController@getProfile', 'middleware' => ['auth']]);
