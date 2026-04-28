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


    });
 
//admin route group end