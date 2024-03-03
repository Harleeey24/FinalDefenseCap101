<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
});

Route::get('signin', [UserController::class, 'login'])->name('signin');
Route::post('signin', [UserController::class, 'signin_action'])->name('signin.action');

Route::get('signup', [UserController::class, 'signup'])->name('signup');
Route::post('signup', [UserController::class, 'signup_action'])->name('signup.action');

Route::get('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('landingpage', [UserController::class, 'landingpage'])->name('landingpage');
Route::get('userdashboard', [UserController::class, 'userdashboard'])->name('userdashboard');

Route::get('password', [UserController::class, 'password'])->name('password');
Route::post('password', [UserController::class, 'password_action'])->name('password.action');


/*navlinks for user*/

Route::get('order', [UserController::class, 'order'])->name('order');
Route::get('profile', [UserController::class, 'profile'])->name('profile');
Route::get('vieworder', [UserController::class, 'vieworder'])->name('vieworder');
Route::get('/userorderonly/{user_id}', [UserController::class, 'userorderonly'])->name('userorderonly');


Route::get('viewuser', [UserController::class, 'viewuser'])->name('viewuser');
Route::delete('/users/{id}', [UserController::class, 'users_delete'])->name('users.delete');
Route::get('users/search', [UserController::class, 'search'])->name('users.search');

//PlaceOrder 
Route::post('order', [UserController::class, 'placeOrder'])->name('place.StoreOrder');

//PlaceOrderDelete
Route::delete('/order/{order_id}', [UserController::class, 'destroy'])->name('order.delete');

//terms and condition
Route::get('terms', [UserController::class, 'terms'])->name('terms');

//ADMINSIDE
Route::get('adminorder', [UserController::class, 'adminorder'])->name('adminorder');
//ORDER COUNTING
Route::get('admin_dashboard', [UserController::class, 'getOrderCount'])->name('admin_dashboard');
//ADMINVIEWUSER
Route::get('admin_viewuser', [UserController::class, 'admin_viewuser'])->name('admin_viewuser');
//ADMINVIEWORDER
Route::get('/userorderonly', [UserController::class, 'userorderonly'])->name('userorderonly');
//Search Orders
Route::get('users/searchOrders', [UserController::class, 'searchOrders'])->name('searchOrders');
//ADMIN CREATE ORDER
Route::get('admin_create', [UserController::class, 'admin_create'])->name('admin_create');
//ADMINPROFILE
Route::get('adminprofile', [UserController::class, 'adminprofile'])->name('adminprofile');
//ADMINORDERVIEWONLY
Route::get('adminorder_only', [UserController::class, 'adminorder_only'])->name('adminorder_only');



//INDIVIDUAL ORDER COUNTING
Route::get('userdashboard', [UserController::class, 'userDashboard'])->name('userdashboard');

//UPDATEORDERDETAILS
Route::put('/adminorder/{id}', [UserController::class, 'adminorder'])->name('order.update');



//EMPLOYEE
Route::get('employee_dashboard', [UserController::class, 'employee_dashboard'])->name('employee_dashboard');
Route::get('employee_order', [UserController::class, 'employee_order'])->name('employee_order');
Route::get('employeevieworder', [UserController::class, 'employeevieworder'])->name('employeevieworder');
Route::get('employee_profile', [UserController::class, 'employee_profile'])->name('employee_profile');
//employee ordercount
Route::get('employee_dashboard', [UserController::class, 'empOrderCount'])->name('employee_dashboard');

//ViewSpecificOrder
Route::get('employeeorder_only', [UserController::class, 'employeeorder_only'])->name('employeeorder_only');



