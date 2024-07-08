<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/dashboard', function () {
//     return view('backend.modules.index');
// })->middleware(['auth'])->name('admin.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile','Backend\ProfileController@edit')->name('profile.edit');
    Route::put('/profile','Backend\ProfileController@update')->name('profile.update');
    Route::delete('/profile','Backend\ProfileController@destroy')->name('profile.destroy');

    Route::get('ticket', 'Backend\TicketController@index')->name('ticket.index');
    Route::get('ticket/create', 'Backend\TicketController@create')->name('ticket.create');
    Route::get('ticket/edit/{id}', 'Backend\TicketController@edit')->name('ticket.edit');
    Route::get('ticket/show/{id}', 'Backend\TicketController@show')->name('ticket.show');
    Route::post('ticket/store', 'Backend\TicketController@store')->name('ticket.store');
    Route::put('ticket/update/{id}', 'Backend\TicketController@update')->name('ticket.update');
    Route::post('ticket/delete', 'Backend\TicketController@delete')->name('ticket.delete');
    Route::post('ticket/filter', 'Backend\TicketController@filter')->name('ticket.filter');
    Route::get('ticket/feedback/{id}', 'Backend\TicketController@feedback')->name('ticket.feedback');
    Route::post('ticket/feedback_store', 'Backend\TicketController@feedback_store')->name('ticket.feedback_store');

    Route::group(['middleware' => 'admin'],static function(){
        Route::get('user', 'Backend\UserController@index')->name('user.index');
        Route::get('user/create', 'Backend\UserController@create')->name('user.create');
        Route::get('user/edit/{id}', 'Backend\UserController@edit')->name('user.edit');
        Route::get('user/show/{id}', 'Backend\UserController@show')->name('user.show');
        Route::post('user/store', 'Backend\UserController@store')->name('user.store');
        Route::put('user/update/{id}', 'Backend\UserController@update')->name('user.update');
        Route::post('user/delete', 'Backend\UserController@delete')->name('user.delete');

        Route::get('subject', 'Backend\SubjectController@index')->name('subject.index');
        Route::get('subject/create', 'Backend\SubjectController@create')->name('subject.create');
        Route::get('subject/edit/{id}', 'Backend\SubjectController@edit')->name('subject.edit');
        Route::get('subject/show/{id}', 'Backend\SubjectController@show')->name('subject.show');
        Route::post('subject/store', 'Backend\SubjectController@store')->name('subject.store');
        Route::put('subject/update/{id}', 'Backend\SubjectController@update')->name('subject.update');
        Route::post('subject/delete', 'Backend\SubjectController@delete')->name('subject.delete');
        
    });
});
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
