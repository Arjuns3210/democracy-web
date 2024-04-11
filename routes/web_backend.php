<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register backend routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Login
Route::get('/', 'LoginController@index')->name('login');
Route::post('login', 'LoginController@login');
Route::get('forgot-password', 'LoginController@forgotPassword')->name('password.request');
Route::post('forgot-password', 'LoginController@forgotPasswordStore')->name('password.email');
Route::get('/reset-password/{token}/{email}', 'LoginController@passwordReset')->name('password.reset')->middleware('signed');
Route::post('/reset-password', 'LoginController@passwordUpdate')->name('password.update');

Route::get('/password_expired', 'AdminController@passwordExpired');
Route::post('/force_reset_password', 'AdminController@resetExpiredPassword');

Route::group(['middleware' => ['customAuth']], function () {

    Route::group(['middleware' => ['checkRoutePermission']], function () {

        Route::get('contest', 'ContestController@index')->name('contest');
        Route::get('contest/add', 'ContestController@add');
        Route::get('contest/view/{id}', 'ContestController@view');
        Route::get('contest/edit/{id}', 'ContestController@edit');
        Route::get('contest/delete/{id}', 'ContestController@destroy');
        Route::get('contest/copy/{id}', 'ContestController@copy');

        Route::get('category', 'CategoryController@index')->name('category');
        Route::get('category/add', 'CategoryController@add');
        Route::get('category/view/{id}', 'CategoryController@view');
        Route::get('category/edit/{id}', 'CategoryController@edit');
        Route::get('category/delete/{id}', 'CategoryController@destroy');

        Route::get('question', 'QuestionController@index')->name('question');
        Route::get('question/add', 'QuestionController@add');
        Route::get('question/view/{id}', 'QuestionController@view');
        Route::get('question/edit/{id}', 'QuestionController@edit');
        Route::get('question/delete/{id}', 'QuestionController@destroy');

        Route::get('location', 'LocationController@index')->name('location');
        Route::get('location/add', 'LocationController@add');
        Route::get('location/view/{id}', 'LocationController@view');
        Route::get('location/edit/{id}', 'LocationController@edit');
        Route::get('location/delete/{id}', 'LocationController@destroy');

        Route::get('customer', 'CustomerController@index')->name('customer');
        Route::get('customer/view/{id}', 'CustomerController@show');

        Route::get('suggested_questions', 'SuggestedQuestionsController@index')->name('suggested_questions');
        Route::get('suggested_questions/view/{id}', 'SuggestedQuestionsController@show');
        Route::post('publish/suggested_questions', 'SuggestedQuestionsController@updateStatus');

        Route::get('banner', 'BannerController@index')->name('banner');
        Route::get('banner/add', 'BannerController@add');
        Route::get('banner/view/{id}', 'BannerController@view');
        Route::get('banner/edit/{id}', 'BannerController@edit');
        Route::post('banner/update', 'BannerController@update');
        Route::get('banner/delete/{id}', 'BannerController@destroy');

        Route::get('enrolled_user', 'EnrolledController@index')->name('enrolled_user');
        Route::get('enrolled_user/view/{id}', 'EnrolledController@show');

        Route::get('winners', 'WinnersController@index')->name('winners');
        Route::get('winners/view/{id}', 'WinnersController@show');

        Route::get('notification', 'NotificationController@index')->name('notification');
        Route::get('notification/add', 'NotificationController@create');
        Route::get('notification/edit/{id}', 'NotificationController@edit');
        Route::get('notification/view/{id}', 'NotificationController@show');

        Route::get('general_settings', 'GeneralSettingController@index')->name('general_settings');
        Route::get('about_us', 'AboutUsController@index')->name('about_us');
        Route::get('terms', 'TermsAndConditionController@index')->name('terms');
        Route::get('privacy_policy', 'PrivacyPolicyController@index')->name('privacy_policy');
        Route::get('customer_report', 'ReportController@index')->name('customer_report');
        Route::get('enrolled_report', 'ReportController@enrolledReport')->name('enrolled_report');
        Route::get('winners_report', 'ReportController@winnersReport')->name('winners_report');

    });

    //banner 
    Route::post('banner/fetch', 'BannerController@fetch');

	Route::get('dashboard', 'DashboardController@index');
	Route::get('dashboard/test', 'DashboardController@index_phpinfo');
	Route::post('admin_dashboard_chart', 'DashboardController@userDashboardChart');

	//profile
	Route::get('/profile', 'AdminController@profile')->name('profile');
	Route::post('/updateProfile', 'AdminController@updateProfile');

	//change password
	Route::get('/updatePassword', 'AdminController@updatePassword')->name('updatePassword');
	Route::post('/resetPassword', 'AdminController@resetPassword');

	//staff
	Route::get('staff', 'StaffController@index')->name('staff');
	Route::post('staff/fetch', 'StaffController@fetch')->name('staff_fetch');
	Route::get('staff/add', 'StaffController@add');
	Route::post('staff/save', 'StaffController@store');
	Route::get('staff/edit/{id}', 'StaffController@edit');
	Route::post('staff/update', 'StaffController@update');
	Route::post('publish/staff', 'StaffController@updateStatus');
	Route::get('staff/view/{id}', 'StaffController@view');
	Route::get('staff/change_password/{id}', 'StaffController@changePassword');
    Route::post('staff/changePassword', 'StaffController@changeStaffPassword');

    //question
	Route::post('question/fetch', 'QuestionController@fetch')->name('question_fetch');
	Route::post('question/save', 'QuestionController@store');
	Route::post('question/update', 'QuestionController@update');
	Route::post('publish/question', 'QuestionController@updateStatus');

    //Contest
	Route::post('contest/fetch', 'ContestController@fetch');

	Route::post('contest/save', 'ContestController@store');
	Route::post('contest/update', 'ContestController@update');
	Route::post('publish/contest', 'ContestController@updateStatus');

	Route::get('mapp_question/{id}', 'ContestController@assignQuestion');
	Route::post('contest/question_list', 'ContestController@questionList')->name('contest/question_list');
	Route::post('save_mapp_question', 'ContestController@saveContestQuestion');
	Route::post('delete_mapped_question', 'ContestController@deleteMappedQuestion');
	Route::get('get_category_filter/{id}', 'ContestController@getCategory');
	Route::get('get_category_filter', 'ContestController@getCategory');

    //category
    Route::post('category/save', 'CategoryController@store');
    Route::post('category/fetch', 'CategoryController@fetch');
    Route::post('category/update', 'CategoryController@update');
    Route::post('publish/category', 'CategoryController@updateStatus');

	//Location
    Route::post('location/save', 'LocationController@store');
    Route::post('location/fetch', 'LocationController@fetch');
    Route::post('location/update', 'LocationController@update');
    Route::post('publish/location', 'LocationController@updateStatus');

    //manage role
	Route::get('roles', 'RoleController@roles')->name('roles');
	Route::post('role/fetch', 'RoleController@roleData')->name('role/fetch');
	Route::get('role_permission/{id}', 'RoleController@assignRolePermission');
	Route::post('publish/permission', 'RoleController@publishPermission');

    //language
    Route::get('language', 'LanguageController@index');
    Route::post('language/fetch', 'LanguageController@fetch');
    Route::get('language/view/{id}', 'LanguageController@view');
    Route::post('language/publish', 'LanguageController@updateStatus');
    Route::get('language/add', 'LanguageController@add');
    Route::post('language/save', 'LanguageController@store');
    Route::get('language/edit/{id}', 'LanguageController@edit');
    Route::post('language/update', 'LanguageController@update');
    Route::get('language/delete/{id}', 'LanguageController@destroy');

	//customer
	Route::post('customer/fetch', 'CustomerController@fetch');
	Route::get('customer/verify/{id}', 'CustomerController@isVerify');
	Route::get('customer/change_password/{id}', 'CustomerController@changePassword');
	Route::post('customer/changePassword', 'CustomerController@changeCustomerPassword');
    Route::post('customer/publish', 'CustomerController@updateStatus');

	//Enrolled User
	Route::post('enrolled/fetch', 'EnrolledController@fetch');
	Route::post('publish/enrolled_user', 'EnrolledController@updateStatus');
    
    Route::post('suggested_questions/fetch', 'SuggestedQuestionsController@fetch');

	//Winners
	Route::post('winners/fetch', 'WinnersController@fetch');
	Route::post('publish/winners', 'WinnersController@updateStatus');

    //general settings
    Route::post('updateSettingInfo', 'GeneralSettingController@updateSetting');

    //about us
    Route::post('about_us/update', 'AboutUsController@update');

    //terms and condition
    Route::post('terms/update', 'TermsAndConditionController@update');

    //privacy policy
    Route::post('privacy_policy/update', 'PrivacyPolicyController@update');

    Route::post('notification/fetch', 'NotificationController@fetch');
    Route::post('notification/save', 'NotificationController@store');
    Route::post('notification/update', 'NotificationController@update');
    Route::get('get_masters_listing/{type}', 'NotificationController@getMastersListing');
    Route::get('notification/send/{id}', 'NotificationController@sendNotification');
    Route::post('notification/send', 'NotificationController@sendUserNotification');

	//Report
    Route::post('user_report_export', 'ReportController@userReportExport');
    Route::post('enrolled_user_export', 'ReportController@enrolledUserExport');
    Route::post('winners_export', 'ReportController@winnersExport');

    //FAQ
    Route::get('faq', "FaqController@index")->name('faq');
    Route::get('faq/add', 'FaqController@create');
    Route::post('faq/save', 'FaqController@store');
    Route::get('faq/edit/{id}', 'FaqController@edit');
    Route::post('faq/update', 'FaqController@update');
    Route::post('faq/fetch', 'FaqController@fetch');
    Route::get('faq/view/{id}', 'FaqController@show');
    Route::post('faq/publish', 'FaqController@updateStatus');

    //enquiry
    Route::get('enquiries', 'EnquiryController@index')->name('enquiries');
    Route::post('enquiries/fetch', 'EnquiryController@fetch');
    Route::get('enquiries/view/{id}', 'EnquiryController@show');
    
    
    // Logout
	Route::get('/logout', function () {
		session()->forget('data');
		return redirect('/webadmin');
	})->name('logout');
});
