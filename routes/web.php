<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Bird
    Route::delete('birds/destroy', 'BirdController@massDestroy')->name('birds.massDestroy');
    Route::post('birds/media', 'BirdController@storeMedia')->name('birds.storeMedia');
    Route::post('birds/ckmedia', 'BirdController@storeCKEditorImages')->name('birds.storeCKEditorImages');
    Route::resource('birds', 'BirdController', ['except' => ['show']]);

    // Egg
    Route::delete('eggs/destroy', 'EggController@massDestroy')->name('eggs.massDestroy');
    Route::resource('eggs', 'EggController', ['except' => ['show']]);

    // Specie
    Route::delete('species/destroy', 'SpecieController@massDestroy')->name('species.massDestroy');
    Route::post('species/media', 'SpecieController@storeMedia')->name('species.storeMedia');
    Route::post('species/ckmedia', 'SpecieController@storeCKEditorImages')->name('species.storeCKEditorImages');
    Route::resource('species', 'SpecieController', ['except' => ['show']]);

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController', ['except' => ['create', 'store', 'show']]);

    // User Bird
    Route::delete('user-birds/destroy', 'UserBirdController@massDestroy')->name('user-birds.massDestroy');
    Route::resource('user-birds', 'UserBirdController');

    // Breeding Pair
    Route::delete('breeding-pairs/destroy', 'BreedingPairController@massDestroy')->name('breeding-pairs.massDestroy');
    Route::resource('breeding-pairs', 'BreedingPairController');

    // Breeding History
    Route::delete('breeding-histories/destroy', 'BreedingHistoryController@massDestroy')->name('breeding-histories.massDestroy');
    Route::resource('breeding-histories', 'BreedingHistoryController');

    // Fostering
    Route::delete('fosterings/destroy', 'FosteringController@massDestroy')->name('fosterings.massDestroy');
    Route::resource('fosterings', 'FosteringController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
