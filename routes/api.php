<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('get-cities',[ApiController::class,'getCities'])->name('get-cities');
Route::get('car-category',[ApiController::class,'carCategory'])->name('car-category');
Route::get('city-with-brands',[ApiController::class,'carCityBrand'])->name('city-with-brands');
Route::get('latest-cars',[ApiController::class,'latestCars'])->name('latest-cars');
Route::get('featured-cars',[ApiController::class,'featuredCars'])->name('featured-cars');
Route::get('car-description/{id}',[ApiController::class,'carDescription'])->name('car-description');
Route::get('company/{id}',[ApiController::class,'companyListing'])->name('company');
Route::post('filter-data',[ApiController::class,'filterCars'])->name('filter-data');
Route::get('app-banners',[ApiController::class,'appBanners'])->name('app-banners');
Route::post('email-verification',[ApiController::class,'emailVerification'])->name('email-verification');
Route::post('verify-otp',[ApiController::class,'otpVerify'])->name('verify-otp');
Route::post('search-cars',[ApiController::class,'searchCars'])->name('search-cars');
Route::post('verify-otp',[ApiController::class,'otpVerify'])->name('verify-otp');
Route::post('search-cars',[ApiController::class,'userSearchHistory'])->name('search-cars');
Route::get('recent-search',[ApiController::class,'recentSearch'])->name('recent-search');
Route::post('delete-history',[ApiController::class,'delSearchHistory'])->name('delete-history');
Route::post('resend-otp', [ApiController::class, 'resendOtp'])->name('resend-otp');
Route::get('car-with-driver',[ApiController::class,'rentWithDriver'])->name('car-with-driver');
Route::get('recommendations',[ApiController::class,'myRecommendation'])->name('recommendations');
Route::post('google-login',[ApiController::class,'googleLogin'])->name('google-login');
Route::get('filter-category',[ApiController::class,'filterCategory'])->name('filter-category');
    // Route::post('wishlist-product/{id}',[ApiController::class,'addwishlist'])->name('wishlist-product');


Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('wishlist-product/{id}',[ApiController::class,'addToWishlist'])->name('wishlist-product');
    Route::get('my-wishlist',[ApiController::class,'myWishlist'])->name('my-wishlist');
    Route::get('my-viewed',[ApiController::class,'viewedCars'])->name('my-viewed');
    Route::get('contacted-cars',[ApiController::class,'contactedCars'])->name('contacted-cars');
    Route::post('update-profile',[ApiController::class,'updateProfile'])->name('update-profile');
    Route::get('user-activity',[ApiController::class,'userActivity'])->name('user-activity');
    Route::post('logout', [ApiController::class, 'logout'])->name('logout');
 	Route::post('car-enquiry', [ApiController::class, 'carEnquiry'])->name('car-enquiry');
    Route::post('delete-user',[ApiController::class,'deleteUserAccount'])->name('delete-user');

  	




});



