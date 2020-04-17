<?php

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

Route::get('/', [
	"uses"	=>"DonationController@index",
	"as"	=>"donation.index"

]);
Route::get('verifyEmail','Auth\RegisterController@verifyEmail')->name('verifyEmail');
Route::get('verify/{email}/{token}','Auth\RegisterController@verify')->name('sendemaildone');

Auth::routes();
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function () {
	Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
  	Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');
  	Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
  	Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');
});


// SSLCOMMERZ Start
	Route::get('/pay', 'PublicSslCommerzPaymentController@index')->name('pay');
 	Route::POST('/success', 'PublicSslCommerzPaymentController@success');
 	Route::POST('/fail', 'PublicSslCommerzPaymentController@fail');
 	Route::POST('/cancel', 'PublicSslCommerzPaymentController@cancel');
 	Route::POST('/ipn', 'PublicSslCommerzPaymentController@ipn');

//SSLCOMMERZ END
Route::get('/messages', 'MessagesController@index')->name('messages');
Route::get('/messages/fetch', 'MessagesController@fetchMessages')->name('fetchMessages');
 Route::POST('/messages/send', 'MessagesController@sendMessages')->name('sendMessages');

Route::get('show/{donation}','DonationController@show_donation')->name('single.donation.show');
Route::get('entrepreneur/{user}','DonationController@entrepreneur')->name('entrepreneur');
Route::get('latest/{id}/show','latestNewsController@index')->name('latestNews');




//transaction starts
Route::get('transaction/success','TransactionController@transaction_success')->name('transaction.succes');
Route::get('transaction/{donation}','TransactionController@index')->name('transaction');
Route::post('transaction','TransactionController@store')->name('transaction.store');
//transaction ends



//profile starts
Route::get('profile/{user}','ProfileController@index')->name('profile');
Route::put('/profile/update/{user}','ProfileController@update')->name('profile.update');
//profile ends



Route::resource('donation', 'DonationController'); 

//event starts
Route::resource('event', 'Backend\EventController'); 
Route::put('/backend/event/restore/{event}',[
		'uses'	=>'Backend\EventController@restore',
		'as'	=>'event.restore'
]); 
Route::delete('/backend/event/forceDestroy/{event}',[
		'uses'	=>'Backend\EventController@forceDestroy',
		'as'	=>'event.force-destroy'
]);
Route::get('/backend/event/{event}',[
		'uses'	=>'DonationController@show_events',
		'as'	=>'show_event'
]);
//event ends

Route::resource('donations', 'Backend\BackendDonation');
Route::delete('/delete/{id}','Backend\BackendDonation@forceDelete')->name('donations.forceDelete');

Route::resource('entrepreneurs', 'EntrepreneurController');

Route::resource('backend', 'Backend\BackendController');

Route::resource('orders', 'Backend\OrderController');





Route::resource('latest', 'BackendLatestController',['except' => ['index']]);
Route::get('latests/{id}','BackendLatestController@index')->name('index');
Route::put('latests/restore/{id}','BackendLatestController@restore')->name('latest.restore');
Route::get('{id}/latests','BackendLatestController@create')->name('latestCreate');
Route::put('restore/{id}', 'EntrepreneurController@restore')->name('entrepreneurs.restore');


//registration and login with google 

Route::get('auth', 'Auth\RegisterController@redirectToProvider')->name('google');
Route::get('/callback', 'Auth\RegisterController@handleProviderCallback')->name('google_call_back');

//registration and login with google 
Route::post('create/{id}','CommentController@create')->name('comment.create');