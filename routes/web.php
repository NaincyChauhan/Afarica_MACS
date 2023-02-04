<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogtagController;
use App\Http\Controllers\BlogcategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventenquiryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\SubextensionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VideogalleryController;
use App\Http\Controllers\ImagegalleryController;
use App\Http\Controllers\UserapplicationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JobapplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CoursecontentController;
use App\Http\Controllers\ListingenquiryController;
use App\Http\Controllers\ConsultController;
use App\Http\Controllers\EventbannerController;
use App\Http\Controllers\DonationController;

// Site Controller
use App\Http\Controllers\Site\JobController as SiteJobController;
use App\Http\Controllers\Site\CourseController as SiteCourseController;
use App\Http\Controllers\Site\UserController as SiteUserController;
use App\Http\Controllers\Site\ListingController as SiteListingController;
use App\Http\Controllers\Site\EventController as SiteEventController;

use App\Http\Controllers\Site\HomeController;

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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('view:cache');
    Artisan::call('optimize:clear');
    return "Cache is cleared";
});

//Website Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/send-message', [HomeController::class, 'sednMessage'])->name('send-message');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/terms-and-conditions', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [HomeController::class, 'policy'])->name('policy');
Route::get('it-Consultancy/apply-now', [HomeController::class, 'applyNow'])->name('apply-now');
Route::post('it-Consultancy/apply-form', [ConsultController::class, 'store'])->name('apply-form');
Route::post('send/application', [HomeController::class, 'storeApplication'])->name('submit-applycation');
Route::get('web/services', [HomeController::class, 'webServices'])->name('web-services');

// Register
Route::post('register-user', [UserController::class, 'registeruser'])->name('registeruser');
Route::post('login-user', [UserController::class, 'loginuser'])->name('loginuser');

// Real-Estate
Route::get('real-estate/listings', [SiteListingController::class, 'index'])->name('real-estate-listing');
Route::get('real-estate/detail/{slug}', [SiteListingController::class, 'detail'])->name('listing-detail');
Route::post('enquiry/now', [SiteListingController::class, 'enquiryNow'])->name('submit-listing-enquiry');
Route::get('real-estate/ajax-search-listing', [SiteListingController::class, 'filter'])->name('ajax-search-real-estate-listing');

// It Consultancy
Route::get('it/consultancy/apply', [HomeController::class, 'itConsultancy'])->name('it-consultancy-form');
Route::get('it/consultancy/jobs', [SiteJobController::class, 'itConsultancy'])->name('it-consultancy-jobs');
Route::get('it/consultancy/courses', [SiteCourseController::class, 'itConsultancy'])->name('it-consultancy-course');
Route::get('it/consultancy/about', [HomeController::class, 'ITAbout'])->name('it-consultancy-about');

// Health Consultancy
Route::get('health/consultancy/apply', [HomeController::class, 'healthConsultancy'])->name('health-consultancy-form');
Route::get('health/consultancy/jobs', [SiteJobController::class, 'healthConsultancy'])->name('health-consultancy-jobs');
Route::get('health/consultancy/courses', [SiteCourseController::class, 'healthConsultancy'])->name('health-consultancy-course');
Route::get('health/consultancy/about', [HomeController::class, 'healthAbout'])->name('health-consultancy-about');

// Jobs
Route::get('jobs', [SiteJobController::class, 'index'])->name('jobs');
Route::get('job/detail/{slug}', [SiteJobController::class, 'detail'])->name('job-detail');
Route::get('ajax-search-listing', [SiteJobController::class, 'filter'])->name('ajax-search-listing');

// Course
Route::get('course/detail/{slug}', [SiteCourseController::class, 'detail'])->name('course-detail');
Route::get('ajax-search-course', [SiteCourseController::class, 'filter'])->name('ajax-search-course');
Route::get('course/review/{course_id}', [SiteCourseController::class, 'courseReview'])->name('course-review');

// Foundation
Route::get('foundation', [HomeController::class, 'foundation'])->name('foundation');
Route::post('send-donation', [HomeController::class, 'Senddonation'])->name('send-donation');
Route::get('foundation/about', [HomeController::class, 'foundationAbout'])->name('foundation-about');

// Event Decor
Route::get('event-decor', [SiteEventController::class, 'index'])->name('event-home');
Route::get('event-decor/gallery/images', [SiteEventController::class, 'imagegallery'])->name('event-images');
Route::get('event-decor/gallery/videos', [SiteEventController::class, 'videogallery'])->name('event-videos');
Route::get('event-decor/events', [SiteEventController::class, 'events'])->name('events');
Route::get('event-decor/event/{slug}', [SiteEventController::class, 'eventDetail'])->name('event-detail');
Route::get('event-decor/contact', [SiteEventController::class, 'contact'])->name('event-contact');
Route::post('event-decor/event-enquiry', [SiteEventController::class, 'sendMessage'])->name('event-enquiry');

// Users pages
Route::group(['middleware' => ['auth:sanctum',  'verified']], function () {
    Route::get('courses/{slug}', [SiteCourseController::class, 'courseContent'])->name('course-content');
    Route::post('/send-review', [HomeController::class, 'sendReview'])->name('send-review');
    Route::post('/buy-course', [SiteCourseController::class, 'buyCourse'])->name('buy-course');
    Route::get('it/consultancy/my-courses', [SiteUserController::class, 'userCourseIt'])->name('user-course-0');
    Route::get('health/consultancy/my-courses', [SiteUserController::class, 'userCourseHealth'])->name('user-course-1');
    Route::get('user/change-password', [SiteUserController::class, 'changePassword'])->name('user-change-password');
    Route::get('user/update-profile', [SiteUserController::class, 'editProfile'])->name('user-update-profile');
    Route::post('update-password', [UserController::class, 'updatePassword'])->name('update-password');
    Route::post('update-profile', [SiteUserController::class, 'updateProfile'])->name('update-profile');
});
    
Auth::routes();
Route::group(['middleware' => ['auth:sanctum', 'role',  'verified']], function () {
    Route::group(['prefix' => 'admin'], function(){
        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');        

        // Real-Estate
        Route::resource('listing', ListingController::class);
        Route::resource('listingenquiry', ListingenquiryController::class);
        
        // Course
        Route::resource('course', CourseController::class);
        Route::resource('coursecontent', CoursecontentController::class);
        
        // Category and Subcategory
        Route::resource('category', CategoryController::class);
        Route::resource('banner', BannerController::class);
        Route::resource('subcategory', SubcategoryController::class);
        
        // It Consultancy And Health Consultancy
        Route::resource('consult', ConsultController::class);
        Route::get('it/consultancy', [ConsultController::class, 'itConsultancy'])->name('it-consultancy-request');
        Route::get('health/consultancy', [ConsultController::class, 'healthConsultancy'])->name('health-consultancy-request');
        
        // Job System
        Route::resource('jobapplication', JobapplicationController::class);
        Route::resource('job', JobController::class);
        
        // Blog System
        Route::resource('blog', BlogController::class);
        Route::resource('blogcategory', BlogcategoryController::class);
        Route::resource('blogtag', BlogtagController::class);
        Route::delete('delete/all/tags', [BlogtagController::class, 'deleteAll'])->name('delete-all-tags');
        
        // Messages
        Route::resource('message', MessageController::class);
        
        Route::resource('role', RoleController::class);
        Route::resource('user', UserController::class);
        Route::resource('staff', StaffController::class);
        
        // Event and decor 
        Route::resource('event', EventController::class);
        Route::resource('eventbanner', EventbannerController::class);
        Route::resource('videogallery', VideogalleryController::class);
        Route::resource('imagegallery', ImagegalleryController::class);
        Route::resource('eventenquiry', EventenquiryController::class);
        
        // Donation
        Route::resource('donation', DonationController::class);
        
        // Policies
        Route::group(["prefix" => "policy"], function(){
            Route::get('terms-and-conditions',[SettingController::class, 'terms'])->name('policy.update.term');
            Route::post('terms-and-conditions', [SettingController::class, 'termsUpdate'])->name('policy.update.term-update');
            
            //Privacy Policy
            Route::get('privacy-policy', [SettingController::class, 'policy'])->name('policy.update.policy');
            Route::post('privacy-policy', [SettingController::class, 'policyUpdate'])->name('policy.update.policy-update');
            
            //Privacy Policy
            Route::get('refund-policy', [SettingController::class, 'refund'])->name('refund.update.policy');
            Route::post('refund-policy', [SettingController::class, 'refundUpdate'])->name('refund.update.refund-update');
        });
        
        Route::group(["prefix" => "setting"], function(){
            //Setting
            Route::get('update-setting', [SettingController::class, 'setting'])->name('update-setting');
            Route::post('update-setting', [SettingController::class, 'settingUpdate'])->name('setting-update');
        });

        //Ajax
        Route::group(["prefix" => "ajax"], function(){
            Route::get('subcategory-by-category-id/{id}', [CategoryController::class, 'subcategoryByCategoryId'])->name('subcategory-by-category-id');
            Route::get('load-banner-table', [BannerController::class, 'loadTable'])->name('load-banner-table');
            Route::get('load-category-table', [CategoryController::class, 'loadTable'])->name('load-category-table');
            Route::get('load-subcategory-table', [SubcategoryController::class, 'loadTable'])->name('load-subcategory-table');
            Route::get('load-blog-table', [BlogController::class, 'loadTable'])->name('load-blog-table');
            Route::get('load-blogcategory-table', [BlogcategoryController::class, 'loadTable'])->name('load-blogcategory-table');
            Route::get('load-blogtag-table', [BlogtagController::class, 'loadTable'])->name('load-blogtag-table');
            Route::get('load-events-table', [EventController::class, 'loadTable'])->name('load-events-table');
            Route::get('load-message-table', [MessageController::class, 'loadTable'])->name('load-message-table');
            Route::get('load-listing-enquiry-table', [ListingenquiryController::class, 'loadTable'])->name('load-listing-enquiry-table');
            Route::get('load-event-enquiry-table', [EventenquiryController::class, 'loadTable'])->name('load-event-enquiry-table');
            Route::get('load-role-table', [RoleController::class, 'loadTable'])->name('role-table');
            Route::get('load-imagegallery-table', [ImagegalleryController::class, 'loadTable'])->name('load-imagegallery-table');
            Route::get('load-videogallery-table', [VideogalleryController::class, 'loadTable'])->name('load-videogallery-table');
            Route::get('load-staff-table', [StaffController::class, 'staffLoadTable'])->name('load-staff-table');
            Route::get('load-user-table', [UserController::class, 'loadTable'])->name('load-user-table');                        
            Route::get('load-jobapplication-table', [JobapplicationController::class, 'loadTable'])->name('load-jobapplication-table');
            Route::get('load-consult-table/{type}', [ConsultController::class, 'loadTable'])->name('load-consult-table');
            Route::get('load-job-table/{type}', [JobController::class, 'loadTable'])->name('load-job-table');
            Route::get('load-course-table/{type}', [CourseController::class, 'loadTable'])->name('load-course-table');
            Route::get('load-coursecontent-table/{course_id}', [CoursecontentController::class, 'loadTable'])->name('load-coursecontent-table');
            Route::get('user/application/data', [JobapplicationController::class, 'ajaxFilter'])->name('ajax-user-application-data');
            Route::get('load-course-table', [ListingController::class, 'loadTable'])->name('load-listing-table');
            Route::get('load-eventbanner-table', [EventbannerController::class, 'loadTable'])->name('load-eventbanner-table');
            Route::get('load-donation-table', [DonationController::class, 'loadTable'])->name('load-donation-table');

            //Status
            Route::put('change-job-status/{id}', [JobController::class, 'ChangeStatus'])->name('change-job-status');
            Route::put('change-staff-status/{id}', [UserController::class, 'staffChangeStatus'])->name('change-staff-status');
            Route::put('change-course-status/{id}', [CourseController::class, 'courseChangeStatus'])->name('change-course-status');
            Route::put('change-listing-status/{id}', [ListingController::class, 'ChangeStatus'])->name('change-listing-status');
            Route::get('delete-messages', [MessageController::class, 'multiDelete'])->name('delete-messages');                        
            Route::get('delete-listing-messages', [ListingenquiryController::class, 'multiDelete'])->name('delete-listing-messages');                        
            Route::get('delete-event-messages', [EventenquiryController::class, 'multiDelete'])->name('delete-event-messages');                        
            Route::get('delete-donations', [DonationController::class, 'multiDelete'])->name('delete-donations');                        
            Route::post('change-jobapplication-status/{id}', [JobapplicationController::class, 'applicationChangeStatus'])->name('change-jobapplication-status');
        });
        Route::get('change-password', [UserController::class, 'changePassword'])->name('change-password');
    });
});
