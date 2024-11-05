<?php

use App\Http\Controllers\VendorController;
use Carbon\Carbon;
use App\Models\BillingInfo;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Models\FrontendModels\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\BackendModels\Product;
use App\Models\FrontendModels\Review;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Models\ProductAdditionalAttribute;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\BillingInfoController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\LogoController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SocialController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\InquiryController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\VariantController;
// use App\Http\Controllers\LoginApi\GoogleController;
use App\Http\Controllers\OrderManagementController;
use App\Http\Controllers\Backend\LocationController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\PortfolioController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\LoginApi\FacebookController;
use App\Http\Controllers\OrderNotificationController;
use App\Http\Controllers\Backend\PageContentController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\CancellationController;
use App\Http\Controllers\Backend\MainCategoryController;
use App\Http\Controllers\Backend\SubscriptionController;
use App\Http\Controllers\Backend\AttributeValueControler;
use App\Http\Controllers\Backend\ConfigurationController;
use App\Http\Controllers\Backend\PrivacyPolicyController;
use App\Http\Controllers\Backend\ParentCategoryController;
use App\Http\Controllers\Backend\ShippingMethodController;
use App\Http\Controllers\Backend\TermsConditionController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GoogleLoginController;
use App\Models\BackendModels\Brand;
use App\Http\Controllers\RefreshController;
use App\Http\Controllers\CarWithDriverController;
use App\Models\CarWithDriver;
use App\Http\Controllers\AppBannerController;



// Auth::routes();

Route::get('admin-login', function () {
    // return 'here';
    return view('auth.login');
});


// Route::get('admin', function () {
//     // return 'here';
//     return view('auth.login');
// })->name('/');


// Route::match(array('get', 'post'), '/admin', array(UserController::class, 'index'))->name('index');


// Route::get('/index2', function () {
//     $brands  = Brand::where('status',1)->get();
//     return view('frontend.index2',get_defined_vars());
// })->name('/quick-guides');



// Route::get('quick-guides', function () {
//     $brands  = Brand::where('status',1)->get();
//     return view('frontend.quick-guides',get_defined_vars());
// })->name('/quick-guides');

// Route::get('viewed_cars', function () {
//     $brands  = Brand::where('status',1)->get();
//     return view('frontend.viewed_cars',get_defined_vars());
// })->name('/viewed_cars');




Route::post('/login',[AdminController::class,'login'])->name('login');

// ADMIN PANEL ROUTES---------------------------------------
Route::group(['middleware' =>  ['preventBackHistory','adminmiddleware'],'prefix' => 'admin'],function () {
    // DASHBOARD
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin-home');
    Route::post('logout',[AdminController::class,'adminlogout'])->name('logout');
    // api resources
    // Route::apiResources(['logo' => 'App\Http\Controllers\Backend\LogoController']);
    Route::apiResources(['homecontent' => 'App\Http\Controllers\Backend\HomeController']);
    Route::apiResources(['gallery' => 'App\Http\Controllers\Backend\GalleryController']);


    // gallery  routes
    Route::get('create-gallery', [GalleryController::class, 'create'])->name('create-gallery');
    Route::get('edit-gallery/{id}', [GalleryController::class, 'edit'])->name('edit-gallery');
    Route::Post('update-gallery/{id}', [GalleryController::class, 'update'])->name('update-gallery');
    Route::post('gallery-delete', [GalleryController::class, 'destroy'])->name('gallery.delete');
    Route::get('gallery-status/{id}',[GalleryController::class,'status'])->name('gallery-status');

    // tesimonial route
    Route::get('testimonial-index', [TestimonialController::class, 'index'])->name('testimonial-index');
    Route::get('testimonial-create', [TestimonialController::class, 'create'])->name('testimonial-create');
    Route::post('testimonial-store', [TestimonialController::class, 'store'])->name('testimonial-store');
    Route::get('edit-testimonial/{id}', [TestimonialController::class, 'edit'])->name('edit-testimonial');
    Route::post('update-testimonial/{id}', [TestimonialController::class, 'update'])->name('update-testimonial');
    Route::post('testimonial-delete', [TestimonialController::class, 'destroy'])->name('testimonial-delte');
    Route::get('testimonial-status/{id}', [TestimonialController::class, 'status'])->name('testimonial-status');

    // faqs route
    Route::resource('faqs', FaqController::class);
    Route::get('faqs-status/{id}', [FaqController::class, 'status'])->name('faqs-status');

    // portfolio route
    Route::resource('portfolio', PortfolioController::class);
    Route::get('portfolio-status/{id}', [PortfolioController::class, 'status'])->name('portfolio-status');

    // Inquiry route
    Route::get('all-inquiries', [InquiryController::class, 'index'])->name('all-inquiries');
    Route::get('all-leads', [InquiryController::class, 'userLeads'])->name('all-leads');
    Route::post('delete-contact/{id}', [InquiryController::class, 'deletecontact'])->name('delete-contact');
    Route::get('view-inquiry/{id}', [InquiryController::class, 'showcontact'])->name('view-inquiry');

    // Package Management Routes
    Route::resource('package', PackageController::class);
    Route::get('package-status/{id}', [PackageController::class, 'status'])->name('package-status');

    Route::resource('shipping',ShippingController::class);
    Route::get('shipping-status/{id}',[ShippingController::class,'status'])->name('shipping-status');

    Route::resource('shipping-method',ShippingMethodController::class);
    Route::get('shipping-method-status/{id}',[ShippingMethodController::class,'status'])->name('shipping-method-status');

    // Configurations
    Route::group(['prefix' => 'configuration'],function(){
        Route::resource('configuration', ConfigurationController::class);
        // Route::get('shipping-status/{id}',[ConfigurationController::class,'status'])->name('shipping-status');
        Route::resource('social', SocialController::class);


    });

    // Service
    Route::resource('service', ServiceController::class);

    // Page Content routes
     Route::group(['prefix' => 'cms'] ,function() {
        Route::resource('logo',LogoController::class);
        Route::resource('page-content',PageContentController::class);
        Route::resource('terms-conditions', TermsConditionController::class);
        Route::resource('privacy-policy', PrivacyPolicyController::class);
        Route::resource('banner',BannerController::class);
        Route::resource('page',PageController::class);
        Route::resource('offers',OfferController::class);
    });



    // category routes
    Route::group(['prefix' => 'category'],function(){
        // Parent category routes
        Route::resource('parent-category',ParentCategoryController::class);
        Route::get('parent-category-status/{id}',[ParentCategoryController::class,'status'])->name('parent-category-status');

        // Main category routes
        Route::resource('main-category',MainCategoryController::class);
        Route::get('main-category-status/{id}',[MainCategoryController::class,'status'])->name('main-category-status');
        Route::get('save-car',[MainCategoryController::class,'saveCarsFromJson'])->name('save-car');
        // Sub category routes
        Route::resource('sub-category',SubCategoryController::class);
        Route::get('sub-category-status/{id}',[SubCategoryController::class,'status'])->name('sub-category-status');
        Route::post('feature',[SubCategoryController::class,'featurecategory'])->name('feature');

    });
    
    // App Banner routes
    
    Route::resource('app-banners',AppBannerController::class);

    // order notification
    Route::post('order-notification', [OrderNotificationController::class,'order_notification'])->name('order_notification');
    Route::post('view-all-order-notification', [OrderNotificationController::class,'view_all_order_notification'])->name('view_all_order_notification');


    // OrderManagement
    Route::group(['prefix' => 'orders'],function(){
        Route::resource('orderManagement', OrderManagementController::class);
        Route::post('order-status/{id}', [OrderManagementController::class,'order_status'])->name('order.status');
        Route::get('invoice/{id}', [OrderManagementController::class,'invoice_index'])->name('invoice.index');
        Route::resource('cancellation-policy',CancellationController::class);
        Route::get('cancellation-status/{id}',[CancellationController::class,'status'])->name('cancellation-status');
    });
    Route::get('order_invoice',[OrderManagementController::class, 'orderinvoice'])->name('order_invoice');
    Route::get('cancel-status/{id}',[OrderManagementController::class,'cancelstatus'])->name('cancel-status');
    Route::get('refund-status/{id}',[OrderManagementController::class,'refundstatus'])->name('refund-status');
    Route::get('order-tracking/{id}',[OrderManagementController::class,'ordertracking'])->name('order-tracking');


    Route::get('decline_cancel-status/{id}',[OrderManagementController::class,'declinecancel'])->name('decline_cancel-status');
    Route::get('decline_refund-status/{id}',[OrderManagementController::class,'declinerefund'])->name('decline_refund-status');


    //  Product Routes

    Route::get('car-listing',[ProductController::class,'carListing'])->name('car-listing');
    Route::get('packages-orders',[AdminController::class,'packagesOrders'])->name('packages-orders');
    Route::post('update-order-status',[AdminController::class,'updateVendorOrder'])->name('update-order-status');
    Route::get('car-with-driver-listing',[ProductController::class,'carWithDriverListing'])->name('car-with-driver-listing');
    Route::get('car-with-driver-listing-details/{id}',[ProductController::class,'carWithDriverListingDetails'])->name('car-with-driver-listing-details');
    Route::get('delete-car/{id}',[ProductController::class,'deleteCar'])->name('delete-car');
    Route::get('view-car-details/{id}',[ProductController::class,'viewCarDetails'])->name('view-car-details');
    Route::get('car-driver-status/{id}',[ProductController::class,'carDriverStatus'])->name('car-driver-status');
     Route::get('get_products',[ProductController::class,'getproduct'])->name('get_products');
     Route::get('save_tags/{id}',[ProductController::class,'savetags'])->name('save_tags');
     Route::post('multiple_image',[ProductController::class,'multipleimage'])->name('multiple_image');
     Route::post('single_image',[ProductController::class,'singleimage'])->name('single_image');
     Route::get('save_quantity/{id}',[ProductController::class,'savestock'])->name('save_quantity');
     Route::get('get_main_category',[ProductController::class,'maincategory'])->name('get_main_category');
     Route::get('get_sub_category',[ProductController::class,'subcategory'])->name('get_sub_category');
     Route::get('get_brand_name',[ProductController::class,'brand'])->name('get_brand_name');
     Route::get('get_product',[ProductController::class,'getproduct'])->name('get_product');
     Route::get('updateproduct',[ProductController::class,'updateproduct'])->name('updateproduct');
     Route::get('get_last_attr',[ProductController::class,'last_att'])->name('get_last_attr');
     Route::get('save_qty',[ProductController::class,'saveqty'])->name('save_qty');
     Route::get('get_attr',[ProductController::class,'getattr'])->name('get_attr');


     Route::post('product_variants',[ProductController::class,'product_variants'])->name('add.product_variants');
     Route::get('remove_product_variants',[ProductController::class,'remove_product_variants'])->name('remove.product_variants');
     Route::get('variant_attributes',[ProductController::class,'variant_attributes'])->name('load.variant_attributes');
     Route::get('product-attributes',[ProductController::class,'add_attribute'])->name('show.product_attributes');
     Route::post('define_product_variant',[ProductController::class,'define_product_variant'])->name('add.define_product_variant');
     Route::post('define_product_variant_edit/{id}',[ProductController::class,'define_product_variant_edit'])->name('edit.define_product_variant');
     Route::get('optionCheck',[ProductController::class,'optionCheck'])->name('optionCheck');
     Route::get('update-status/{id}',[ProductController::class,'updateStatus'])->name('update-status');

     Route::get('premium-product',[ProductController::class,'premiumProduct'])->name('premium-product');

    //  edit tabs
     Route::post('product/{id}',[ProductController::class,'updateproductdata'])->name('update-prevdata');
     Route::get('product/edit/{id}',[ProductController::class,'edit_attribute'])->name('edit.product');
     Route::get('product-variation',[ProductController::class,'product_variation'])->name('add.product_variation');
     Route::post('product-variation',[ProductController::class,'store_product_variation'])->name('add.product_variation');
     Route::get('edit-product-variation/{id}',[ProductController::class,'edit_product_variation'])->name('edit.product_variation');
     Route::get('delete-variation/{id}',[ProductController::class,'delete_variation'])->name('delete-variation');
     Route::get('remove-variation-session/{id}',[ProductController::class,'remove_session'])->name('remove-variation-session');

     Route::get('product-attributes/edit/{id}',[ProductController::class,'edit_product_attr'])->name('edit.product_attributes');
     Route::get('product-setting',[ProductController::class,'product_setting'])->name('product-setting');
     Route::post('product-setting-save',[ProductController::class,'product_setting_save'])->name('product-setting-save');


    // Coupon routes

    Route::resource('coupon',CouponController::class);
    Route::get('coupon-status/{id}',[CouponController::class,'status'])->name('coupon-status');
    Route::get('get_attributes_all',[CouponController::class,'getdata'])->name('get_attributes_all');
    Route::get('search_products_attr', [CouponController::class,'selectSearch'])->name('search_products_attr');
    Route::get('products_attr_variation', [CouponController::class,'variationSearch'])->name('products_attr_variation');
    //  Product Variants
    Route::resource('variants',VariantController::class);
    Route::get('variants-status/{id}',[VariantController::class,'status'])->name('variants-status');
    Route::get('attribute-value/{id}',[AttributeValueControler::class,'attributevalue'])->name('attribute-value');
    Route::resource('attribute-value',AttributeValueControler::class);
    Route::get('attribute-status/{id}',[AttributeValueControler::class,'status'])->name('attribute-status');
    //  Brand Routes
    Route::resource('brand',BrandController::class);
    Route::get('get_main_category',[BrandController::class,'maincategory'])->name('get_main_category');
    Route::get('brand-status/{id}',[BrandController::class,'status'])->name('brand-status');
    Route::get('get_brand_name',[BrandController::class,'brand'])->name('get_brand_name');


    // Location routes
    Route::resource('location',LocationController::class);
    Route::get('location-status/{id}',[BrandController::class,'status'])->name('location-status');


    // Blog routes

        Route::get('blog-index',[BlogController::class,'index'])->name('blog-index');
        Route::get('blog-create',[BlogController::class,'create'])->name('blog-create');
        Route::post('blog-store',[BlogController::class,'store'])->name('blog-store');
        Route::get('blog-edit/{id}',[BlogController::class,'edit'])->name('blog-edit');
        Route::post('blog-update/{id}',[BlogController::class,'update'])->name('blog-update');
        Route::get('blog-delete/{id}',[BlogController::class,'delete'])->name('blog-delete');
        Route::get('blog-status/{id}',[BlogController::class,'status'])->name('blog-status');

    // Pages route
    Route::get('page-status/{id}', [PageController::class, 'status'])->name('page-status');

    // Review Routes
    Route::get('reviews',[ReviewController::class,'index'])->name('reviews');
    Route::get('reviews-detail/{id}',[ReviewController::class,'details'])->name('reviews-detail');
    Route::get('reviews-status/{id}',[ReviewController::class,'status'])->name('reviews-status');
    Route::post('review-toggle',[ReviewController::class,'reviewtoggle'])->name('review-toggle');
    Route::post('review-delete/{id}',[ReviewController::class,'deletereview'])->name('review-delete');

    // Vendor Management
    Route::get('vendors', [UserController::class, 'index'])->name('vendor-index');
    Route::get('vendor-create', [UserController::class, 'create'])->name('vendor-create');
    Route::post('vendor-store', [UserController::class, 'store'])->name('vendor-store');
    Route::get('vendor-edit/{id}', [UserController::class, 'edit'])->name('vendor-edit');
    Route::post('vendor-update/{id}', [UserController::class, 'update'])->name('vendor-update');
    Route::post('vendor-delete/{id}', [UserController::class, 'delete'])->name('vendor-delete');
    Route::get('vendor-status/{id}', [UserController::class, 'status'])->name('vendor-status');
    Route::get('vendor-details/{id}', [UserController::class, 'vendorDetails'])->name('vendor-details');

    // User Management

    Route::get('users',[UserController::class,'users'])->name('users-index');
    Route::get('user-create',[UserController::class,'createUser'])->name('user-create');
    Route::get('user-details/{id}',[UserController::class,'userDetails'])->name('user-details');
    Route::get('user-edit/{id}', [UserController::class, 'userEdit'])->name('user-edit');
    Route::post('user-update/{id}', [UserController::class, 'userUpdate'])->name('user-update');
    Route::post('user-delete/{id}', [UserController::class, 'userDelete'])->name('user-delete');
    Route::get('user-status/{id}', [UserController::class, 'userStatus'])->name('user-status');

    Route::get('manage-active-listing',[UserController::class,'manageActive'])->name('manage-active-listing');
    Route::get('edit-active-lisitng/{id}',[UserController::class,'editListing'])->name('edit-active-lisitng');
    Route::post('update-lisitng/{id}',[UserController::class,'lisitngUpdate'])->name('update-lisitng');
    // Refresh cars
    Route::get('company-refreshes',[RefreshController::Class,'index'])->name('company-refreshes');
    Route::get('add-refreshes',[RefreshController::Class,'create'])->name('add-refreshes');
    Route::get('refreshes-edit/{id}',[RefreshController::class,'edit'])->name('refreshes-edit');
    Route::post('refresh-store',[RefreshController::class,'refreshStore'])->name('refresh-store');
    Route::post('refresh-update/{id}',[RefreshController::class,'update'])->name('refresh-update');


    // Subscription
    Route::get('subscription',[SubscriptionController::class,'index'])->name('subscription');
    Route::post('subscription-delete/{id}',[SubscriptionController::class,'delete'])->name('subscription-delete');
    // simple route
    Route::get('/create_content', [App\Http\Controllers\Backend\HomeController::class, 'create_view'])->name('create_content');
});

Route::get('/login/google',[GoogleLoginController::class,'redirect'])->name('login.google-redirect');
Route::get('/login/google/callback',[GoogleLoginController::class,'callback'])->name('login.google-callback');


// Route::get('/login/google', 'GoogleLoginController@redirect')->name('login.google-redirect');
// Route::get('/login/google/callback', 'GoogleLoginController@callback')->name('login.google-callback');

Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

    Route::get('/',[FrontendController::class,'index'])->name('home');
    Route::get('contact-us',[FrontendController::class,'contact'])->name('contact-us');
    Route::get('blogs',[FrontendController::class,'blogs'])->name('blogs');
    Route::get('blog-details',[FrontendController::class,'blogDetails'])->name('blog-details');
    Route::get('allBrands', [FrontendController::class, 'Brands'])->name('brands');
    Route::get('faq',[FrontendController::class,'faqs'])->name('faq');
    Route::get('car-with-driver/{service_type?}',[FrontendController::class,'carwithDriver'])->name('car-with-driver');
    Route::get('country-driving-license',[FrontendController::class,'drivingLicense'])->name('country-driving-license');
    Route::get('desert-safari',[FrontendController::class,'desertSafari'])->name('desert-safari');
    Route::get('rent-a-car-dubai/{slug?}',[FrontendController::class,'ourServices'])->name('rent-a-car-dubai');
    Route::get('list-your-rental-cars',[FrontendController::class,'carRental'])->name('list-your-rental-cars');
    Route::get('our-locations',[FrontendController::class,'ourLocations'])->name('our-locations');
    Route::get('privacy-policy',[FrontendController::class,'privacyPolicy'])->name('privacy-policy');
    Route::get('terms-and-conditions',[FrontendController::class,'termsConditions'])->name('terms-and-conditions');
    Route::get('terms-of-use',[FrontendController::class,'termsOfuse'])->name('terms-of-use');
    Route::get('about-us',[FrontendController::class,'aboutUs'])->name('about-us');
    Route::get('pricing',[FrontendController::class,'ourPricing'])->name('pricing');
    Route::get('car-details/{slug}',[FrontendController::class,'carDetails'])->name('car-details');
    Route::get('chauffeur-service/{slug}',[FrontendController::Class,'chauffeurDetails'])->name('chauffeur-service');
    Route::get('dubai-car-with-driver/{slug}',[FrontendController::class,'carWithDriverDetails'])->name('dubai-car-with-driver');
    Route::get('rent/{slug}/dubai',[FrontendController::class,'rentCars'])->name('rent');
    Route::post('email-otp',[FrontendController::class,'emailOtp'])->name('email-otp');
    Route::post('email-verify',[FrontendController::class,'emailVerify'])->name('email-verify');

    Route::post('register-company',[FrontendController::class,'registerCompany'])->name('register-company');
    Route::get('company/{slug}',[FrontendController::class,'companyProfile'])->name('company-profile');
    Route::get('add-wishlist', [UserDashboardController::class,'addToWishlist'])->name('wishlist.add');
    Route::get('car-leads',[FrontendController::class,'leads'])->name('car-leads');
    Route::get('call-leads',[FrontendController::class,'phoneLeads'])->name('call-leads');
    Route::get('get_mileage_price',[FrontendController::class,'getMileagePrice'])->name('get_mileage_price');
    Route::get('get_car_models',[FrontendController::class,'getModels'])->name('get_car_models');
    Route::get('get_make_years',[FrontendController::class,'makeYear'])->name('get_make_years');
    Route::get('get_company_models',[FrontendController::class,'companyCarModels'])->name('get_company_models');
    Route::get('car_make_years',[FrontendController::class,'carMakeYears'])->name('car_make_years');
    Route::get('search-brands/{slug}',[FrontendController::class,'getDataBrands'])->name('search-brands');
    Route::get('clear-filters',[FrontendController::Class,'clearFilters'])->name('clear-filters');
    Route::get('clear-filter',[FrontendController::class,'clearFilter'])->name('clear-filter');
    Route::post('send-enquiry',[FrontendController::class,'sendEnquiry'])->name('send-enquiry');
    Route::get('companies',[FrontendController::class,'allCompanies'])->name('companies');
    Route::get('company-details/{slug}',[FrontendController::class,'companyDetails'])->name('company-details');
    Route::get('details-new',[FrontendController::Class,'detailsNew'])->name('details-new');
  	Route::get('rent-cheap-economy-cars-dubai',[FrontendController::class,'economyDubai'])->name('rent-cheap-economy-cars-dubai');
    Route::get('luxury-car-rental-dubai',[FrontendController::class,'luxuryDubai'])->name('luxury-car-rental-dubai');
    Route::get('rent-sports-cars-in-dubai',[FrontendController::class,'sportsDubai'])->name('rent-sports-cars-in-dubai');
    Route::get('rent-special-edition-car-dubai',[FrontendController::class,'specialEditionDubai'])->name('rent-special-edition-car-dubai');
    Route::get('rent-muscles-cars-in-dubai',[FrontendController::class,'muscleCars'])->name('rent-muscles-cars-in-dubai');
    Route::get('rent-hybrid-electrical-cars-dubai',[FrontendController::class,'electricCarsDubai'])->name('rent-hybrid-electrical-cars-dubai');
    // Route::get('/car-rentals/{type}', [FrontendController::class, 'show'])->name('car-rentals');
    Route::get('{type}-car-rentals', [FrontendController::class, 'show'])->name('car-rentals');
    // Route::get('{type}-car-rental', [FrontendController::class, 'carBrands'])->name('car-brands');
    Route::get('/brands/{brand?}-car-rental', [FrontendController::class, 'showBrand'])->where('brand', '[A-Za-z0-9\-]+')->name('brand-car-rental');
    // vendor routes


    Route::middleware(['preventBackHistory','profilemiddleware'])->group(function () {
        Route::get('user-logout',[UserDashboardController::class,'userlogout'])->name('user-logout');
        Route::get('my-profile',[UserDashboardController::class,'myProfile'])->name('my-profile');
        Route::get('my-activities',[UserDashboardController::class,'myActivity'])->name('my-activities');
        Route::get('quick-guide',[UserDashboardController::class,'quickGuide'])->name('quick-guide');
        Route::get('viewed-cars',[UserDashboardController::class,'viewedCars'])->name('viewed-cars');
        Route::get('contacted',[UserDashboardController::class,'contactedCars'])->name('contacted');
        Route::get('wishlist',[UserDashboardController::class,'wishlist'])->name('wishlist');
        Route::get('bookings',[UserDashboardController::class,'carBookings'])->name('bookings');
        Route::post('update-profile',[UserDashboardController::class,'updateProfile'])->name('update-profile');
        Route::get('remove-wishlist/{id}', [UserDashboardController::class, 'wishlistDelete'])->name('remove-wishlist');
        Route::get('get-car-details',[UserDashboardController::class,'getCarDetails'])->name('get-car-details');


    });



    // Vendor Dashboard Routes

Route::get('login',[VendorController::class,'login'])->name('login');
Route::post('vendor-login',[VendorController::class,'vendorLogin'])->name('vendor-login');
Route::post('add-password',[FrontendController::class,'addPassword'])->name('add-password');

Route::get('set-password',[FrontendController::class,'setPassword'])->name('set-password');

Route::middleware(['preventBackHistory','usermiddleware'])->group(function () {

    Route::resource('rent-car',VendorController::class);
    Route::resource('rent-car-with-driver', CarWithDriverController::class);
    Route::get('change-status/{id}',[CarWithDriverController::class,'changeStatus'])->name('change-status');
    Route::get('get_main_category',[VendorController::class,'maincategory'])->name('get_main_category');
    Route::get('get_make_year',[VendorController::class,'getMakeyear'])->name('get_make_year');
    Route::get('contact-info',[VendorController::class,'contactInfo'])->name('contact-info');
    Route::post('update-account',[VendorController::class,'updateAccount'])->name('update-account');
    Route::get('vendor-dashboard',[VendorController::class,'vendorHome'])->name('vendor-dashboard');
    Route::get('vendor-profile',[VendorController::class,'vendorProfile'])->name('vendor-profile');

    Route::get('buy-refreshes',[VendorController::class,'buyRefreshes'])->name('buy-refreshes');
    Route::get('/package-details/{id}', [VendorController::class, 'getPackageDetails'])->name('package.details');
    Route::post('store-order-history',[VendorController::class,'storeOrderHistory'])->name('store-order-history');


    Route::get('order-history',[VendorController::class,'orderHistory'])->name('order-history');
    Route::get('trade-license',[VendorController::class,'tradeLicense'])->name('trade-license');
    Route::post('upload-license',[VendorController::class,'uploadLicense'])->name('upload-license');
    Route::post('update-vendorProfile',[VendorController::class,'updateVendorProfile'])->name('update-vendorProfile');
    Route::get('get_model_category',[VendorController::class,'getModelCategory'])->name('get_model_category');

    Route::group(['prefix' => 'leads'],function(){
        Route::get('car-analytics',[VendorController::class,'carAnalytics'])->name('car-analytics');
        Route::get('lead-analytics',[VendorController::class,'leadPerformance'])->name('lead-analytics');
        Route::get('lead-analytics-date/{slug?}',[VendorController::class,'leadPerformanceDate'])->name('leadPerformanceDate');
        Route::get('car-rental-leads',[VendorController::class,'carLeads'])->name('car-rental-leads');
    });

    Route::resource('product', ProductController::class);
    Route::get('product-status/{id}',[ProductController::class,'status'])->name('product-status');
    Route::get('manage-offers',[VendorController::class,'manageCars'])->name('manage-offers');
    Route::get('get_car_prices',[VendorController::class,'getCarPrice'])->name('get_car_prices');
    Route::post('add-discount',[VendorController::class,'addDiscount'])->name('add-discount');
    Route::post('feature-car',[VendorController::class,'addFeatureCar'])->name('feature-car');
    Route::get('refresh-car/{id}',[VendorController::class,'refreshCars'])->name('refresh-car');
    Route::post('vendor-logout',[VendorController::class,'vendorlogout'])->name('vendor-logout');
    Route::get('enquiries',[VendorController::class,'carEnquiries'])->name('enquiries');
    Route::get('enquiry-detail/{id}',[VendorController::class,'enquiriesDetails'])->name('enquiry-detail');
});
Route::get('sitemap.xml', [FrontendController::class, 'sitemap']);


Route::get('/clear', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    // return view('frontend.cache');
})->name('clear.cache');

// Route::any('{url}', function () {
//     return view('frontend.404');
// })->where('url', '.*');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    });
