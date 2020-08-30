<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\User;
//Route to home page
Route::get('/','HomeController@index')->name('root');
Route::get('/coming_soon','HomeController@coming_soon');
Route::get('/error','HomeController@error');
Route::get('/forgot_password','HomeController@forgot_password');

// Route::get('/', function(){
// 	// $name = DB::Connection()->getTablePrefix();
// 	// $results = DB::select('select * from users where id = ?', [1]);
// 	// $users = DB::table('users')->get();
// 	$pw = bcrypt('password');
// 	return 'Connected to ' .$pw;
// });

//route to user service page
Route::get('/userservices','UserServicesController@index');
//route to admin services page
Route::get('/adminservices','AdminServicesController@index');

//route to admin services page
Route::get('/course/{name?}','CourseServicesController@index');

Route::get('/settings', 'ProfileServiceController@getSettings');
Route::get('/profile', 'ProfileServiceController@getProfile');

Route::get('/messages', 'ProfileServiceController@getMessages');
Route::get('/users/{id?}','ProfileServiceController@getPublicProfile');
Route::get('/users/{id?}/networks','ProfileServiceController@getPublicNetworks');

Route::get('/profile/networks', 'ProfileServiceController@getProfileNetworks');

Route::get('/profile/services', 'ProfileServiceController@services');

Route::get('/business','BusinessServiceController@getBusiness');

Route::get('/referral','ReferralServiceController@getReferral');

//Route::get('/payment','PaymentController@show');
Route::post('/stripe/webhook', 'StripeController@WebhookController');

Route::get('/coursemodule','CourseModuleServiceController@index');

Route::get('/home', function() 
{
	$User = Auth::User();
	if(Auth::check()) //if user is authenticated
	{
		if($User->admin==1) //if admin login then show admin view
		{
			return view('profile.adminservices');
		}
		else
		{
			return Redirect::to('profile');
		}
	}
});

Route::get('auth/facebook', 'Auth\RegisterController@fbProvider');
Route::get('/logout', function () {
    Auth::logout();
		return view('landing.home');
});
Route::get('auth/facebook/callback', 'Auth\RegisterController@fbCallback');
Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'EmailController@confirm'
]);

Route::get('auth/google', 'Auth\RegisterController@googleProvider');
Route::get('/callback/google', 'Auth\RegisterController@googleFeedback');
//Route::post('/register','Auth\RegisterController@create');
//Route::post('/login','Auth\LoginController@authenticate');


// Authentication Routes...
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//Auth::routes();
Route::get('/email/success', 'EmailController@success');


// Route::post('/login', 'Auth\LoginController@authenticate');
// Route::post('/login', function () {
//     error_log($data);
// 	if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => 1]))
// 	{
// 	    return redirect()->intended('pages/adminservices');
// 	} else {
// 	    return redirect()->intended('pages/userservices');
// 	}
// });
// 
//Route::post('/send', 'EmailController@send');
Route::post('/addPreRegisterUser','PreRegisterController@addPreRegisterUser');
Route::post('/payment/monthly','PaymentController@monthly');
Route::post('/payment/yearly','PaymentController@yearly');
//Route::post('/payment/success''PaymentController@success');
Route::post('/cancellation', 'PaymentController@cancellation');
Route::post('/updateCoupon', 'PaymentController@updateCoupon');
Route::post('/updateUser', 'ProfileServiceController@updateUser');
Route::post('/updateUserContact', 'ProfileServiceController@updateUserContact');
Route::post('/updateUserSettings', 'ProfileServiceController@updateUserSettings');

Route::post('/saveUpdateExperience', 'ProfileServiceController@saveUpdateExperience');

// Route::post('/login', 'Auth\LoginController@authenticate');
// Route::post('/login', function () {
//     error_log($data);
// 	if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => 1]))
// 	{
// 	    return redirect()->intended('pages/adminservices');
// 	} else {
// 	    return redirect()->intended('pages/userservices');
// 	}
// });
Route::post('/addPreRegisterUser','PreRegisterController@addPreRegisterUser');

Route::post('/uploadFileToS3', 'ProfileServiceController@uploadFileToS3');

Route::post('/connectUsers', 'ProfileServiceController@connectUsers');

Route::post('/findUsers', 'ProfileServiceController@findUsers');

Route::post('/course','CourseServicesController@addCourse');

Route::post('/addComment','CourseServicesController@addComment');

Route::post('/coursemodule','CourseModuleServiceController@addCourseModule');

Route::post('/fetchSectionVideo', 'CourseServicesController@fetchSectionVideo');

Route::post('/fetchComments', 'CourseServicesController@fetchComments');

Route::post('/fetchSubComments', 'CourseServicesController@fetchSubComments');

Route::post('/coursemodule','CourseModuleServiceController@addCourseModule');

Route::post('/fetchReplies', 'CourseServicesController@fetchReplies');

Route::post('/addUserVideo', 'CourseServicesController@addUserVideo');

Route::post('/viewSubsection', 'CourseServicesController@viewSubsection');

Route::post('/sendMessage', 'MessagesController@sendMessage');

Route::get('/messages/findUsers', 'MessagesController@findUsers');

Route::post('/createConversation', 'MessagesController@createConversation');

Route::post('/readMessages', 'MessagesController@readMessages');

Route::get('/reviews/business', 'ProfileServiceController@businessReviews');

Route::get('/businesses', 'BusinessController@index');

Route::get('/business/search', 'BusinessController@search');

Route::post('/business/addCustomer', 'BusinessController@addCustomer');
Route::get('/business/{id?}/gallery', 'BusinessController@images');
Route::post('/business/uploadFileToS3', 'BusinessController@uploadFileToS3');
Route::post('/business/removeService', 'BusinessController@removeService');
Route::post('/business/likeUnlikeImage', 'BusinessController@likeUnlikeImage');
Route::get('/stacks', 'BusinessController@stackImages');
Route::post('/business/commentImage', 'BusinessController@commentImage');
Route::post('/business/updateImageCaption', 'BusinessController@updateImageCaption');
Route::post('/business/removeImage', 'BusinessController@removeImage');
Route::post('/business/stackImage', 'BusinessController@stackImage');
Route::post('/business/sendEmail', 'BusinessController@sendEmail');
Route::post('/business/unstackImage', 'BusinessController@unstackImage');
Route::post('/business/imageComments', 'BusinessController@getImageComments');
Route::post('/business/review', 'BusinessController@createReview');
Route::get('/business/{id?}/reviews', 'BusinessController@reviews');

Route::post('/email/send','EmailController@send');
Route::post('/service/webdesign','EmailController@sendWebService');
Route::post('/service/apparel','EmailController@sendApparelService');
Route::post('/service/social','EmailController@sendSocialMediaService');
Route::post('/service/business','EmailController@sendBusinessService');
