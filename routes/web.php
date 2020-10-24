<?php

Route::get('/', 'ArticleController@index');

Route::get('/article/{id}/{slug}.html', 'ArticleController@showArticle')
    ->where('id', '\d+')
    ->name('blog.show');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
});

//Account
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', function() {
        \Auth::logout();
        return redirect(route('login'));
    })->name('logout');
    Route::get('/my/account', 'AccountController@index')->name('account');

    /** Comments */
    Route::post('/comments/add', 'CommentController@addComment')->name('comments.add');

    //Admin
    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
        Route::get('/', 'Admin\AccountController@index')->name('admin');

        /** Categories */
        Route::get('/categories', 'Admin\CategoryController@index')->name('categories');
        Route::get('/categories/add', 'Admin\CategoryController@addCategory')->name('categories.add');
        Route::post('/categories/add', 'Admin\CategoryController@addRequestCategory');
        Route::get('/categories/edit/{id}', 'Admin\CategoryController@editCategory')
            ->where('id', '\d+')
            ->name('categories.edit');
        Route::post('/categories/edit/{id}', 'Admin\CategoryController@editRequestCategory')
            ->where('id', '\d+');
//        Route::get('/categories/delete', 'Admin\CategoryController@deleteCategory')->name('categories.delete');
        Route::delete('/categories/delete', 'Admin\CategoryController@deleteCategory')->name('categories.delete');

        /** Articles */
        Route::get('/articles', 'Admin\ArticleController@index')->name('articles');
        Route::get('/articles/add', 'Admin\ArticleController@addArticle')->name('articles.add');
        Route::post('/articles/add', 'Admin\ArticleController@addRequestArticle');

        Route::get('/articles/edit/{id}', 'Admin\ArticleController@editArticle')
            ->where('id', '\d+')
            ->name('articles.edit');
        Route::post('/articles/edit/{id}', 'Admin\ArticleController@editRequestArticle')->where('id', '\d+');
        Route::delete('/articles/delete', 'Admin\ArticleController@deleteArticle')->name('articles.delete');

        /** Users */
        Route::get('/users', 'Admin\UserController@index')->name('users');

        Route::get('/comments', 'Admin\CommentController@index')->name('comments');
        Route::get('/comments/accepted/{id}', 'Admin\CommentController@acceptComment')
            ->where('id', '\d+')
            ->name('comments.accepted');
    });
});
