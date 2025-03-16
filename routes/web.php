<?php


use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\CityController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\offerController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequestRouteController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



Route::get('/', function () {
    return view('landing-page');
});


Route::get('/landing-page', function () {
    return view('landing-page');
});

Route::get('/landing-faq', [DashboardController::class, 'faq_category']);
Route::get('/landing-faq/faq-general', [DashboardController::class, 'show_faq_general']);
Route::get('/landing-faq/faq-peralatan', [DashboardController::class, 'show_faq_peralatan']);
Route::get('/landing-faq/faq-harga', [DashboardController::class, 'show_faq_harga']);
Route::get('/landing-faq/faq-pengiriman', [DashboardController::class, 'show_faq_pengiriman']);



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
    Route::get('/admin/dashboard', [DashboardController::class, 'index_admin'])->name('admin.dashboard');

    // Contaniner
    Route::get('/admin/container', [ContainerController::class,'index']);
    Route::get('/admin/container-add', [ContainerController::class,'add']);
    Route::post('/admin/container-add', [ContainerController::class,'store']);
    Route::get('/admin/container/{id}/edit', [ContainerController::class, 'edit']);
    Route::put('/admin/container/{id}', [ContainerController::class, 'update']);
    Route::delete('/admin/container/{id}', [ContainerController::class, 'destroy'])->name('container.destroy');

    // Service
    Route::get('/admin/service', [ServiceController::class,'index']);
    Route::get('/admin/service-add', [ServiceController::class,'add']);
    Route::post('/admin/service-add', [ServiceController::class,'store']);
    Route::get('/admin/service/{id}/edit', [ServiceController::class, 'edit']);
    Route::put('/admin/service/{id}', [ServiceController::class, 'update']);
    Route::delete('/admin/service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');

    // Category
    Route::get('/admin/category', [CategoryController::class, 'index']);
    Route::get('/admin/category-add', [CategoryController::class, 'add']);
    Route::post('/admin/category-add', [CategoryController::class, 'store']);
    Route::get('/admin/category/{id}/edit', [CategoryController::class, 'edit']);
    Route::put('/admin/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Province
    Route::get('/admin/province', [ProvinceController::class, 'index']);
    Route::get('/admin/province-add', [ProvinceController::class, 'add']);
    Route::post('/admin/province-add', [ProvinceController::class, 'store']);
    Route::get('/admin/province/{id}/edit', [ProvinceController::class, 'edit']);
    Route::put('/admin/province/{id}', [ProvinceController::class, 'update']);
    Route::delete('/admin/province/{id}', [ProvinceController::class, 'destroy'])->name('province.destroy');
    
    //City
    Route::get('/admin/city', [CityController::class, 'index']);
    Route::get('/admin/city-add', [CityController::class, 'add']);
    Route::post('/admin/city-add', [CityController::class, 'store']);
    Route::get('/admin/city/{id}/edit', [CityController::class, 'edit']);
    Route::put('/admin/city/{id}', [CityController::class, 'update']);
    Route::delete('/admin/city/{id}', [CityController::class, 'destroy'])->name('city.destroy');

    // FAQs
    Route::get('/admin/faq', [FaqController::class, 'index']);
    Route::get('/admin/faq-add', [FaqController::class, 'add']);
    Route::post('/admin/faq-add', [FaqController::class, 'store']);
    Route::get('/admin/faq/{id}/edit', [FaqController::class, 'edit']);
    Route::put('/admin/faq/{id}', [FaqController::class, 'update']);
    Route::delete('/admin/faq/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');


    //Laporan
    Route::get('/admin/report-user', [LaporanController::class, 'index_user']);
    Route::get('/admin/report-shipment', [LaporanController::class, 'index_shipment']);
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





