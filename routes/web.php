<?php

use App\Http\Controllers\Frontend\ContactUsPageController;
use App\Http\Controllers\Frontend\FaqPageController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\PrivacyPageController;
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



Route::get('/', [HomePageController::class, 'fetchHome'])->name('home');

// Contact Us
Route::get('contact',[ContactUsPageController::class, 'index']);
Route::post('contact_us', [ContactUsPageController::class, 'storeContactForm'])->name('contact_us');

// Faq
Route::get('faq', [FaqPageController::class, 'fetchFaq']);

// Privacy Page
Route::get('privacy', [PrivacyPageController::class, 'fetchPrivacy']);

// Terms Page
Route::get('terms', [TermsPageController::class, 'fetchTerms']);
