<?php

Route::view('/', 'welcome');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Product Unit
    Route::delete('product-units/destroy', 'ProductUnitController@massDestroy')->name('product-units.massDestroy');
    Route::resource('product-units', 'ProductUnitController');

    // Product Brand
    Route::delete('product-brands/destroy', 'ProductBrandController@massDestroy')->name('product-brands.massDestroy');
    Route::resource('product-brands', 'ProductBrandController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/parse-csv-import', 'ProductCategoryController@parseCsvImport')->name('product-categories.parseCsvImport');
    Route::post('product-categories/process-csv-import', 'ProductCategoryController@processCsvImport')->name('product-categories.processCsvImport');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Attribute
    Route::delete('product-attributes/destroy', 'ProductAttributeController@massDestroy')->name('product-attributes.massDestroy');
    Route::post('product-attributes/parse-csv-import', 'ProductAttributeController@parseCsvImport')->name('product-attributes.parseCsvImport');
    Route::post('product-attributes/process-csv-import', 'ProductAttributeController@processCsvImport')->name('product-attributes.processCsvImport');
    Route::resource('product-attributes', 'ProductAttributeController');

    // Product Variation
    Route::delete('product-variations/destroy', 'ProductVariationController@massDestroy')->name('product-variations.massDestroy');
    Route::post('product-variations/parse-csv-import', 'ProductVariationController@parseCsvImport')->name('product-variations.parseCsvImport');
    Route::post('product-variations/process-csv-import', 'ProductVariationController@processCsvImport')->name('product-variations.processCsvImport');
    Route::resource('product-variations', 'ProductVariationController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/parse-csv-import', 'ProductController@parseCsvImport')->name('products.parseCsvImport');
    Route::post('products/process-csv-import', 'ProductController@processCsvImport')->name('products.processCsvImport');
    Route::resource('products', 'ProductController');

    // City
    Route::delete('cities/destroy', 'CityController@massDestroy')->name('cities.massDestroy');
    Route::post('cities/parse-csv-import', 'CityController@parseCsvImport')->name('cities.parseCsvImport');
    Route::post('cities/process-csv-import', 'CityController@processCsvImport')->name('cities.processCsvImport');
    Route::resource('cities', 'CityController');

    // Sales Person
    Route::delete('sales-people/destroy', 'SalesPersonController@massDestroy')->name('sales-people.massDestroy');
    Route::post('sales-people/parse-csv-import', 'SalesPersonController@parseCsvImport')->name('sales-people.parseCsvImport');
    Route::post('sales-people/process-csv-import', 'SalesPersonController@processCsvImport')->name('sales-people.processCsvImport');
    Route::resource('sales-people', 'SalesPersonController');

    // Sales Order
    Route::delete('sales-orders/destroy', 'SalesOrderController@massDestroy')->name('sales-orders.massDestroy');
    Route::post('sales-orders/parse-csv-import', 'SalesOrderController@parseCsvImport')->name('sales-orders.parseCsvImport');
    Route::post('sales-orders/process-csv-import', 'SalesOrderController@processCsvImport')->name('sales-orders.processCsvImport');
    Route::resource('sales-orders', 'SalesOrderController');

    // Sales Order Detail
    Route::delete('sales-order-details/destroy', 'SalesOrderDetailController@massDestroy')->name('sales-order-details.massDestroy');
    Route::resource('sales-order-details', 'SalesOrderDetailController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
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
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Product Unit
    Route::delete('product-units/destroy', 'ProductUnitController@massDestroy')->name('product-units.massDestroy');
    Route::resource('product-units', 'ProductUnitController');

    // Product Brand
    Route::delete('product-brands/destroy', 'ProductBrandController@massDestroy')->name('product-brands.massDestroy');
    Route::resource('product-brands', 'ProductBrandController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Attribute
    Route::delete('product-attributes/destroy', 'ProductAttributeController@massDestroy')->name('product-attributes.massDestroy');
    Route::resource('product-attributes', 'ProductAttributeController');

    // Product Variation
    Route::delete('product-variations/destroy', 'ProductVariationController@massDestroy')->name('product-variations.massDestroy');
    Route::resource('product-variations', 'ProductVariationController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::resource('products', 'ProductController');

    // City
    Route::delete('cities/destroy', 'CityController@massDestroy')->name('cities.massDestroy');
    Route::resource('cities', 'CityController');

    // Sales Person
    Route::delete('sales-people/destroy', 'SalesPersonController@massDestroy')->name('sales-people.massDestroy');
    Route::resource('sales-people', 'SalesPersonController');

    // Sales Order
    Route::delete('sales-orders/destroy', 'SalesOrderController@massDestroy')->name('sales-orders.massDestroy');
    Route::resource('sales-orders', 'SalesOrderController');

    // Sales Order Detail
    Route::delete('sales-order-details/destroy', 'SalesOrderDetailController@massDestroy')->name('sales-order-details.massDestroy');
    Route::resource('sales-order-details', 'SalesOrderDetailController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
