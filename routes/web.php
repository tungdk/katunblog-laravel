<?php

use Illuminate\Support\Facades\Route;
//use App\Author;
//use App\Category;
//use App\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Pages\HomeController@home');
Route::get('/home','Pages\HomeController@home');

Route::get('/{id}-{title}','Pages\BlogpostController@blogpost');
Route::get('/category/{id}/{title}','Pages\CategoryController@category');

Route::get('/contact','Pages\ContactController@contact');
Route::post('/contact','Pages\ContactController@postcontact');

Route::get('/user/account','Pages\AccountController@getAccount');
Route::post('/user/account','Pages\AccountController@postAccount');

Route::get('/user/change-password','Auth\ChangePasswordController@getChangePassword');
Route::post('/user/change-password','Auth\ChangePasswordController@postChangePassword');

Route::get('/user/comment','Pages\AccountController@getUserComment');

Route::get('/about','Pages\AboutController@about');

Route::get('search','PagesController@search');
Route::get('search-auto','PagesController@search_auto');

Route::get('/email_footer','PagesController@email_footer');

Route::group(['middleware'=>'userLogin'],function () {
    Route::post('/comment', 'Pages\BlogpostController@postComment');
    Route::post('/rating', 'Pages\BlogpostController@postRating');
});
Route::get('/checkLogin/redirect_url/{url}','Pages\CheckLoginController@getCheckLogin');

Route::get('/404formUrl/{url}','PagesController@error_page');
//Auth
Route::get('/password/email','Auth\ForgotPasswordController@getFormEmailResetPassword');
Route::post('/password/email','Auth\ForgotPasswordController@postFormEmailResetPassword');
Route::get('/password/reset','Auth\ForgotPasswordController@getFormResetPassword')->name('get.link.reset.password');
Route::post('/password/reset','Auth\ForgotPasswordController@postFormResetPassword');

//Route::get('/login','Auth\LoginController@getLogin');
Route::post('/login','Auth\LoginController@postLogin');
Route::get('/logout','Auth\LogoutController@getLogout');

Route::post('/register','Auth\RegisterController@RegisterEmail');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function (){
    Route::get('/','Admin\DashboardController@index');
    Route::get('dashboard','Admin\DashboardController@index');
    Route::group(['prefix'=>'category'],function (){
        Route::get('all','Admin\CategoryController@all');
        Route::get('add','Admin\CategoryController@add');
        Route::post('add','Admin\CategoryController@create')->name('category.add');
        Route::get('edit/{id}','Admin\CategoryController@edit')->name('category.edit');
        Route::post('edit/{id}','Admin\CategoryController@update');
        Route::get('delete/{id}','Admin\CategoryController@delete')->name('category.delete');
        Route::get('search', 'Admin\CategoryController@search')->name('category.search');
    });
    Route::group(['prefix'=>'author'],function (){
        Route::get('all','Admin\AuthorController@all');
        Route::get('detail/{id}','Admin\AuthorController@detail');
        Route::get('edit/{id}','Admin\AuthorController@edit');
        Route::post('edit/{id}','Admin\AuthorController@update');
        Route::get('delete/{id}','Admin\AuthorController@delete');
        Route::get('delete_comment/{id}','Admin\AuthorController@delete_comment');

    });

    Route::group(['prefix'=>'user'],function (){
        Route::get('all','Admin\UserController@all');
        Route::get('detail/{id}','Admin\UserController@detail');
        Route::get('edit/{id}','Admin\UserController@edit');
        Route::post('edit/{id}','Admin\UserController@update');
        Route::get('delete/{id}','Admin\UserController@delete');
        Route::get('delete_comment/{id}','Admin\UserController@delete_comment');
    });

    Route::group(['prefix'=>'post'],function (){
        Route::get('all','Admin\PostController@all');
        Route::get('add','Admin\PostController@add');
        Route::post('add','Admin\PostController@create');
        Route::get('detail/{id}','Admin\PostController@detail');
        Route::get('edit/{id}','Admin\PostController@edit');
        Route::post('edit/{id}','Admin\PostController@update');
        Route::get('delete/{id}','Admin\PostController@delete');
        Route::get('delete_comment/{id}','Admin\PostController@delete_comment');

    });
    Route::group(['prefix'=>'comment'],function (){
        Route::get('all','Admin\CommentController@all');
        Route::get('delete/{id}','Admin\CommentController@delete')->name('comment.delete');
    });

});
Route::get('ahihi', function (){
   $pass = bcrypt('admin');
   echo $pass;
});
