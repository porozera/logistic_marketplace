<?php


use App\Models\Service;
use App\Models\Category;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FAQCustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RequestRouteController;
use App\Http\Controllers\RequestRouteLspController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\offerController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\DaftarPenawaranController;
use App\Http\Controllers\DashboardCustomerController;
use App\Http\Controllers\NotificationCustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileCustomerController;
use App\Http\Controllers\SearchRouteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TrackingController;
use App\Http\Livewire\MapLocation;
use App\Models\City;
use Illuminate\Http\Request;
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
Route::get('/terms-of-service/lsp', function () {return view('auth.terms_of_service_lsp');});
Route::get('/terms-of-service/customer', function () {return view('auth.terms_of_service_customer');});
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
    Route::get('/lsp/dashboard', [OfferController::class, 'index'])->name('lsp-dashboard');
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
    Route::prefix('permintaan-pengiriman')->group(function(){
        Route::get('/', [RequestRouteLspController::class, 'index'])->name('permintaan.pengiriman');
        Route::get('/{id}', [RequestRouteLspController::class, 'show']);
    });
    Route::prefix('bids')->group(function(){
        Route::post('store', [BidController::class, 'store'])->name('bids.store');
        Route::get('create/{id}', [BidController::class, 'create'])->name('bids.create');
    });
    Route::prefix('profile')->group(function(){
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        // Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/{id}', [ProfileController::class, 'update'])->name('profile.update');
    });
});

Route::middleware(['auth', RoleMiddleware::class . ':customer'])->group(function () {
    Route::get('/customer/dashboard', [DashboardController::class, 'index_customer']);

    //REQUEST ROUTES
    Route::get('/request-routes', [RequestRouteController::class, 'index'])->name('request-route');
    Route::post('/request-routes/perform', [RequestRouteController::class, 'store'])->name('request-route.perform');
    Route::get('/request-routes/success', [RequestRouteController::class, 'success'])->name('request-success');

    //SEARCH ROUTES
    Route::get('/search-routes', [SearchRouteController::class, 'index'])->name('search-route');
    Route::get('/search-routes/{id}', [SearchRouteController::class, 'detail'])->name('search-route.detail');
    Route::get('/profile/lsp/{id}', [SearchRouteController::class, 'profile_lsp'])->name('profile-lsp');

    //ORDERS
    Route::get('/order/{id}', [OrderController::class, 'index'])->name('order');
    Route::post('/order/perform', [OrderController::class, 'order'])->name('order.perform');

    //PAYMENTS
    Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
    Route::get('/payment/{token}', [PaymentController::class, 'index'])->name('payment');
    Route::get('/payment/success/{token}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/list-payment', [PaymentController::class, 'list_payment'])->name('list-payment');
    Route::get('/invoice/{token}', [PaymentController::class, 'invoice'])->name('invoice');
    Route::get('/invoice/{token}/download', [PaymentController::class, 'invoice_download'])->name('invoice.download');


    //PROFILE CUSTOMER
    Route::get('/profile/customer', [ProfileCustomerController::class, 'index'])->name('profile-customer');
    Route::get('/profile/customer/edit', [ProfileCustomerController::class, 'edit'])->name('profile-customer.edit');
    Route::put('/profile/customer/edit/perform', [ProfileCustomerController::class, 'update'])->name('profile-customer.update');

    //FAQ
    Route::get('/FAQ-customer', [FAQCustomerController::class, 'index'])->name('FAQ-customer');

    //DAFTAR PENAWARAN
    Route::get('/list-offer', [DaftarPenawaranController::class, 'index'])->name('list-offer');
    Route::get('/list-offer/{id}', [DaftarPenawaranController::class, 'detail'])->name('list-offer.detail');
    Route::get('/list-offer/order/{id}', [DaftarPenawaranController::class, 'order_form'])->name('list-offer.order_form');
    Route::post('/list-offer/order/perform', [DaftarPenawaranController::class, 'order'])->name('list-offer.order.perform');

    //NOTIFICATION
    Route::get('/notification-customer', [NotificationCustomerController::class, 'index'])->name('notification-customer');
    Route::put('/notification-customer/update/{id}', [NotificationCustomerController::class, 'update_status'])->name('notification-customer.markAsRead');
    Route::put('/notification-customer/markallasread', [NotificationCustomerController::class, 'markAllAsRead'])->name('notification-customer.markAllAsRead');
    Route::delete('/notification-customer/delete/{id}', [NotificationCustomerController::class, 'destroy'])->name('notification-customer.delete');

    //TRACKING
    Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking-customer');
    Route::get('/tracking/detail/{id}', [TrackingController::class, 'detail'])->name('tracking-customer.detail');

    //REVIEW
    Route::get('/review', [ReviewController::class, 'index'])->name('review');
    Route::post('/review/create/perform', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/review/edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/review/update/{id}/perform', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/delete/{id}', [ReviewController::class, 'destroy'])->name('review.delete');

    //COMPLAIN
    Route::get('/complain', [ComplainController::class, 'index'])->name('complain');
    Route::get('/complain/detail/{id}', [ComplainController::class, 'detail'])->name('complain.detail');
    Route::get('/complain/create', [ComplainController::class, 'create'])->name('complain.create');
    Route::post('/complain/create/perform', [ComplainController::class, 'store'])->name('complain.create.store');

    //DASHBOARD
    Route::get('/dashboard/customer', [DashboardCustomerController::class, 'index'])->name('dashboard-customer');
});





