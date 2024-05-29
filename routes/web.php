<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\ForgotPasswordManager;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

Route::get("/", function () {
    return view("homeview");
})->name("home");
Route::get("/extra", function () {
    return view("createdata");
})->name("extra");
Route::get("/about", function () {
    return view("aboutview");
})->name("about");
Route::get("/login", function () {
    return view("loginview");
})->name("login")->middleware('onlyguest');
Route::get("/buy", function () {
    return view("buyview");
})->name("buy");


//admin pannel
// Route::get('/showdata', [BusController::class, 'showdata']);
Route::get('/createdata', [BusController::class, 'createdata'])->name('createdata.view');
Route::post('/storedata', [BusController::class, 'storedata'])->name('createdata.store');
Route::get('/editdata/{id}', [BusController::class, 'edit']);
Route::post('/updatedata/{id}', [BusController::class, 'update']);
Route::put('/bus/{bus}', [BusController::class, 'update'])->name('bus.update');
Route::delete('/bus/{bus}', [BusController::class, 'destroy'])->name('bus.destroy');
Route::get('/showdata', [BusController::class, 'showdata'])->name('showdata'); // buslist will be shown from admin panel
route::get('/seat_info', [AdminController::class, 'seat_info'])->name('seat_info.view');


//user pannel
Route::post('/register', [AuthController::class, 'register'])->name("register");
Route::post('/log_in', [AuthController::class, 'log_in'])->name('log_in');
Route::get('/log_out', [AuthController::class, 'log_out'])->name('log_out');
Route::get('/view_profile', [AuthController::class, 'view_profile'])->name('view_profile');
Route::get('/edit_profile', [AuthController::class, 'edit_profile'])->name('edit_profile');
Route::post('/update_profile', [AuthController::class, 'update_profile'])->name('update_profile');

Route::get('/layout', function () {
    return view('layout');
});
// web.php or routes/web.php

Route::get('change_password', [AuthController::class, 'change_password'])->name('change_password')->middleware('onlyuser');
Route::post('update_password', [AuthController::class, 'update_password'])->name('update_password')->middleware('onlyuser');
Route::get('/search_bus', [SearchController::class, 'search_bus'])->name('search_bus');
Route::get('seat_management', [SearchController::class, 'seat_management'])->name('seat_management')->middleware('notguest');
Route::get('/seat_view/{id}', [SearchController::class, 'seat_view'])->name('seat_view');
Route::get('/temporary', [BusController::class, 'temporary'])->name('temporary'); //just for checking
// Route::get('/showbustable', [YourControllerName::class, 'show_bus'])->name('show_bus');
// Route::post('/showbustable', [SearchController::class, 'search_bus'])->name('search_bus');

//forgot password
Route::get('/forgot_password', [ForgotPasswordManager::class, 'forgot_password'])->name('forgot_password.view')->middleware('onlyguest');
Route::post('/forgot_password', [ForgotPasswordManager::class, 'forgot_passwordPost'])->name('forgot_passwordPost')->middleware('onlyguest');
Route::get('/resetPassword/{token}', [ForgotPasswordManager::class, 'resetPassword'])->name('resetPassword')->middleware('onlyguest');
Route::post('/resetPassword', [ForgotPasswordManager::class, 'resetPasswordPost'])->name('resetPasswordPost');



// payment gateway
// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
// Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);
Route::get('/payment_details', [SearchController::class, 'payment_details'])->name('payment_details');
route::get('/showdownloadinfo', [SearchController::class, 'showdownloadinfo'])->name('showdownloadinfo');
Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::get('/downloadTicket', [SearchController::class, 'downloadTicket'])->name('downloadTicket');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::match(['get', 'post'], '/success', [SslCommerzPaymentController::class, 'success'])->name('payment.success');
Route::post('/fail', [SslCommerzPaymentController::class, 'fail'])->name('payment.fail');
Route::get('/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn'])->name('payment.ipn');


Route::get('/master2', function () {
    return view('layout.navbar');
});


// this function will only available for backend developer
route::get('/AdminRegisterPost', [AdminController::class, 'AdminRegisterPost'])->name('AdminRegisterPost');

route::get('/purchase_history', [AuthController::class, 'purchase_history'])->name('purchase_history');

Route::get('/custom_register', [CustomController::class, 'custom_register'])->name('custom_register.view');
Route::post('/custom_register', [CustomController::class, 'custom_registerPost'])->name('custom_registerPost');
route::get('/admin.dashboard', [AdminController::class, 'admin_dashboard'])->name('admin.dashboard');
Route::get('/custom_login', [CustomController::class, 'custom_login'])->name('custom_login.view')->middleware('dashoboard');
Route::post('/custom_login', [CustomController::class, 'custom_loginPost'])->name('custom_loginPost');
Route::post('/fetch_bus_data', [AdminController::class, 'fetchBusData'])->name('fetch_bus_data');
// seat_info
route::get('/admin_seat_info_button', [AdminController::class, 'admin_seat_info_button'])->name('admin_seat_info_button');
Route::get('/admin_seat_view/{id}', [AdminController::class, 'admin_seat_view'])->name('admin_seat_view');
// admin.showuser route
Route::get('/showuser', [AdminController::class, 'showuser'])->name('admin_show_all_user');
Route::get('/admin_search', [AdminController::class, 'admin_search'])->name('admin_search');

//adminLogOut
Route::get('/adminLogOut', [AdminController::class, 'adminLogOut'])->name('adminLogOut');
//adminOrders
Route::get('/adminOrders', [AdminController::class, 'adminOrders'])->name('adminOrders');
//adminOrderSearch
Route::get('/adminOrderSearch', [AdminController::class, 'adminOrderSearch'])->name('adminOrderSearch');
//SSLCOMMERZ END
