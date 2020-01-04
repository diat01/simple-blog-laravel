<?php

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
*/

Route::get('site-bakimda', function(){
    return view('front.offline');
});

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function () {
    Route::get('giris', 'Back\AuthController@login')->name('login');
    Route::post('giris', 'Back\AuthController@loginPost')->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    Route::get('panel', 'Back\Dashboard@index')->name('dashboard');
    // Makale route
    Route::get('/makaleler/silinenler', 'Back\ArticleController@trashed')->name('trashed.article');
    Route::resource('/makaleler', 'Back\ArticleController');
    Route::get('/switch', 'Back\ArticleController@switch')->name('switch');
    Route::get('/recoverarticle/{id}', 'Back\ArticleController@recover')->name('recover.article');
    Route::get('/harddeletearticle/{id}', 'Back\ArticleController@hardDelete')->name('hard.delete.article');
    // Kategori route
    Route::get('/kategoriler', 'Back\CategoryController@index')->name('category.index');
    Route::post('/kategoriler/create', 'Back\CategoryController@create')->name('category.create');
    Route::post('/kategoriler/update', 'Back\CategoryController@update')->name('category.update');
    Route::post('/kategoriler/delete', 'Back\CategoryController@delete')->name('category.delete');
    Route::get('/kategori/status', 'Back\CategoryController@switch')->name('category.switch');
    Route::get('/kategori/getData', 'Back\CategoryController@getData')->name('category.getdata');
    // Page route
    Route::get('/sayfalar', 'Back\PageController@index')->name('page.index');
    Route::get('/sayfalar/olustur', 'Back\PageController@create')->name('page.create');
    Route::post('/sayfalar/olustur', 'Back\PageController@post')->name('page.post');
    Route::get('/sayfalar/guncelle/{id}', 'Back\PageController@update')->name('page.update');
    Route::post('/sayfalar/guncelle/{id}', 'Back\PageController@updatePost')->name('page.update.post');
    Route::get('/sayfalar/sil/{id}', 'Back\PageController@delete')->name('page.delete');
    Route::get('/sayfalar/siralama', 'Back\PageController@orders')->name('page.orders');
    Route::get('/sayfa/switch', 'Back\PageController@switch')->name('page.switch');
    // Config route
    Route::get('/ayarlar', 'Back\ConfigController@index')->name('config.index');
    Route::post('/ayarlar/update', 'Back\ConfigController@update')->name('config.update');
    //
    Route::get('cikis', 'Back\AuthController@logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', 'Front\Homepage@index')->name('homepage');
Route::get('/sayfa', 'Front\Homepage@index');
Route::get('/iletisim', 'Front\Homepage@contact')->name('contact');
Route::post('/iletisim', 'Front\Homepage@contactpost')->name('contact.post');
Route::get('/kategori/{category}', 'Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}', 'Front\Homepage@single')->name('single');
Route::get('/{sayfa}', 'Front\Homepage@page')->name('page');
