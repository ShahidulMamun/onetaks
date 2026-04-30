<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserJobController;
use App\Http\Controllers\User\UserDepositController;
use App\Http\Controllers\User\UserDealController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ContinentController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserWithdrawController;

use Illuminate\Support\Facades\Route;

// web pages
Route::get('/', function () {
    return view('welcome');
});

Route::get('about-us', [FrontendController::class, 'aboutUs'])->name('about');
Route::get('privacy-policy', [FrontendController::class, 'policy'])->name('policy');
Route::get('terms-conditions', [FrontendController::class, 'terms'])->name('terms'); 
Route::get('microjob-marketplace', [FrontendController::class, 'marketplace'])->name('marketplace'); 
Route::get('deal-marketplace', [FrontendController::class, 'dealMarketplace'])->name('deal');


// Guest routes (login/register)
Route::middleware('guest.redirect')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


// Protected routes
Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//user routes group
Route::middleware(['auth', 'user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'userDashboard'])
            ->name('dashboard');

       //profile route
        Route::get('/profile', [UserProfileController::class, 'userProfile'])
            ->name('profile');
        Route::post('/profile-update', [UserProfileController::class, 'userProfileUpdate'])
            ->name('profile.update');
        Route::post('/password-update', [UserProfileController::class, 'userPasswordUpdate'])
            ->name('password.update');
        Route::post('/photo-update', [UserProfileController::class, 'userPhotoUpdate'])
            ->name('photo.update');


        //job route
        Route::get('/create-job',  [UserJobController::class, 'create'])->name('create.job');
        Route::post('/create-job', [UserJobController::class, 'store'])->name('create.job.store');
        Route::get('/my-jobs',  [UserJobController::class, 'myjobs'])->name('my.jobs');
        Route::get('/find-jobs',  [UserJobController::class, 'findjobs'])->name('find.jobs'); 
        Route::get('/finished-job',  [UserJobController::class, 'finishedjobs'])->name('finished.jobs'); 


        //deal route
        Route::get('/browse-deal',  [UserDealController::class, 'browsedeal'])->name('browse.deal'); 
        Route::get('/deal-create',  [UserDealController::class, 'dealcreate'])->name('deal.create');
        Route::get('/my-deal-post',  [UserDealController::class, 'mydealpost'])->name('my.deal.post'); 
        Route::get('/deal-order',  [UserDealController::class, 'dealorder'])->name('deal.order');


        //deposit route
        Route::get('/deposit',  [UserDepositController::class, 'create'])->name('deposit');
        Route::get('/deposit-history',  [UserDepositController::class, 'depositHistory'])->name('deposit.history');


        Route::get('continents/', [UserJobController::class, 'continents']);
        Route::get('continents/{id}/countries',[UserJobController::class, 'countries']);
        Route::get('job-categories',[UserJobController::class, 'categories']);
        Route::get('job-categories/{id}/subcategories',[UserJobController::class, 'subcategories']);
        //withdraw route

          //deposit route
        Route::get('/withdraw',  [UserWithdrawController::class, 'index'])->name('withdraw');
        Route::get('/withdraw-create',  [UserWithdrawController::class, 'create'])->name('withdraw.create');
        Route::get('/withdraw-history',  [UserWithdrawController::class, 'withdrawHistory'])->name('withdraw.history');


  });
//user routes group end

//admin route group
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'adminDashboard'])
            ->name('dashboard');

        //continents route
        Route::get('/continent-add', [ContinentController::class, 'index'])->name('continent');
        Route::post('/continent-store', [ContinentController::class, 'store'])->name('continent.store');

        //country route
        Route::get('/country-add', [CountryController::class, 'index'])
            ->name('country');
        Route::post('/country-store', [CountryController::class, 'store'])
            ->name('country.store');

        //category route
        Route::get('/category-add', [CategoryController::class, 'index'])
            ->name('category');
        Route::post('/category-store', [CategoryController::class, 'store'])
            ->name('category.store');
        Route::get('/subcategory-add', [SubCategoryController::class, 'index'])
            ->name('subcategory');
        Route::post('/subcategory-store', [SubCategoryController::class, 'store'])
            ->name('subcategory.store');

        //method method route
        Route::get('/payment-method', [PaymentMethodController::class, 'index'])
            ->name('payment.method'); 
        Route::post('/payment-method-store', [PaymentMethodController::class, 'store'])
            ->name('payment-method.store');   
        Route::post('/payment-method/update', [PaymentMethodController::class, 'update'])->name('payment-method.update');
       Route::delete('/payment-method/delete/{id}', [PaymentMethodController::class, 'delete'])->name('payment-method.delete');

       //site setting route
       Route::get('/website-setting/', [SettingController::class, 'index'])->name('setting');
       Route::post('/settings-update', [SettingController::class, 'update'])->name('settings.update');

       //user route(for admin)
       Route::get('/users/', [UserController::class, 'index'])->name('users');
       Route::post('/user-status-update/', [UserController::class, 'userActiveInactive'])->name('update-user-status');
      
      Route::get('/user-delete/{id}', [UserController::class, 'delete'])->name('user-delete');
   


    });
 
//admin route group end