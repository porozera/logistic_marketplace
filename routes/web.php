<?php


use App\Models\Service;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\offerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\RequestRouteController;
use App\Models\Category;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



Route::get('/', function () {
    return view('landing-page');
});


Route::get('/landing-page', function () {
    return view('landing-page');
});



Route::prefix('offers')->group(function(){
    Route::get('/', [OfferController::class, 'index'])->name('offers.index');
    Route::get('search', [OfferController::class, 'search'])->name('offers.search');
    Route::get('create', [OfferController::class, 'create'])->name('offers.create');
    Route::post('store', [OfferController::class, 'store'])->name('offers.store');
    Route::get('/{id}', [OfferController::class, 'show'])->name('offers.show');
    Route::get('/{id}/edit', [OfferController::class, 'edit'])->name('offers.edit');
    Route::put('/{id}', [OfferController::class, 'update'])->name('offers.update');
    Route::delete('/{id}', [OfferController::class, 'destroy'])->name('offers.destroy');
});



// Route::get('/kontainer', function () {
//     return view('admin.kontainer');
// });

// Route::get('/kontainer-add', function () {
//     return view('admin.kontainer-add');
// });

Route::get('/register-customer', [RegisterController::class, 'create_customer'])->middleware('guest')->name('register-customer');
Route::post('/register-customer', [RegisterController::class, 'store_customer'])->middleware('guest')->name('register-customer.perform');
Route::get('/register-lsp', [RegisterController::class, 'create_lsp'])->middleware('guest')->name('register-lsp');
Route::post('/register-lsp', [RegisterController::class, 'store_lsp'])->middleware('guest')->name('register-lsp.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
// Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
// Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
// Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
// Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
// Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index_admin']);
    // Service
    Route::get('/service', [ServiceController::class,'index']);
    Route::get('/service-add', [ServiceController::class,'add']);
    Route::post('/service-add', [ServiceController::class,'store']);
    Route::get('/service/{id}/edit', [ServiceController::class, 'edit']);
    Route::put('/service/{id}', [ServiceController::class, 'update']);
    Route::delete('/service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');

    // Contaniner
    Route::get('/kontainer', [ContainerController::class,'index']);
    Route::get('/kontainer-add', [ContainerController::class,'add']);
    Route::post('/kontainer-add', [ContainerController::class,'store']);
    Route::get('/kontainer/{id}/edit', [ContainerController::class, 'edit']);
    Route::put('/kontainer/{id}', [ContainerController::class, 'update']);
    Route::delete('/kontainer/{id}', [ContainerController::class, 'destroy'])->name('kontainer.destroy');

    // Category
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category-add', [CategoryController::class, 'add']);
    Route::post('/category-add', [CategoryController::class, 'store']);
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit']);
    Route::put('/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // FAQs
    Route::get('/faq', [FaqController::class, 'index']);
    Route::get('/faq-add', [FaqController::class, 'add']);
    Route::post('faq-add', [FaqController::class, 'store']);
    Route::get('faq/{id}/edit', [FaqController::class, 'edit']);
    Route::put('faq/{id}', [FaqController::class, 'update']);
    Route::delete('faq/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');

});

Route::middleware(['auth', RoleMiddleware::class . ':lsp'])->group(function () {
    Route::get('/lsp/dashboard', [DashboardController::class, 'index']);
});

Route::middleware(['auth', RoleMiddleware::class . ':customer'])->group(function () {
    Route::get('/customer/dashboard', [DashboardController::class, 'index_customer']);

    //REQUEST ROUTES
    Route::get('/request-routes', [RequestRouteController::class, 'index'])->name('request-route');
    Route::post('/request-routes/perform', [RequestRouteController::class, 'store'])->name('request-route.perform');
    Route::get('/request-routes/success', [RequestRouteController::class, 'success'])->name('request-success');
});





