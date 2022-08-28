<?php
use App\Http\Resources\AccessResource;
use App\Models\Access;
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

Route::get('/links', 'LinkController@index')->name("links")->middleware('auth');
Route::get('/accounts/{id}', 'AccountController@show')->middleware('auth');
Route::get('/transactions/{id}', 'TransactionController@show')->middleware('auth');
Route::post('/transactions/search', 'TransactionController@filter')->name('transactions.filter.post')->middleware('auth');

Route::get('/accounts', function () {
    return redirect()->route('links');
});

Route::get('/transactions', function () {
    return redirect()->route('links');
});

Route::get('/', function () {
    return redirect()->route('links');
});

Route::get('/get-access-token', 'ConnectWidgetController@getAccessToken');
Route::post('/add-link', 'ConnectWidgetController@addLink')->name('user.link.post');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');



