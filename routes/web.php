<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['only-logout',])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/login', [AuthController::class, 'index'])->name('login-page');
    Route::get('/registration', [AuthController::class, 'registrationPage'])->name('registration-page');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/registration', [AuthController::class, 'registration'])->name('registration');
});


Route::get('/sign-out', [AuthController::class, 'signOut'])->name('sign-out')->middleware('auth');

Route::get('/lang/{locale}', [LanguageController::class, 'changeLanguage'])->name('lang.switch');


Route::middleware(['auth', 'verified', 'lang', 'check-role:admin'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::put('/item/{item}/update', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/photo/{photo}/delete', [PhotoController::class, 'destroy'])->name('photo.destroy');
    Route::post('/photo/{item}/store', [PhotoController::class, 'store'])->name('photo.store');
    Route::post('/delete/{user}/user', [UserController::class, 'destroy'])->name('user.destroy');
    Route::delete('/delete/{category}/category', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/item/store/{category}', [ItemController::class, 'store'])->name('item.store');
    Route::delete('/delete/{item}/item', [ItemController::class, 'destroy'])->name('item.destroy');
    Route::get('/users', [UserController::class, 'getUsers'])->name('dashboard.users');
    Route::get('/dashboard/categories', [CategoryController::class, 'getCategories'])->name('dashboard.categories');
    Route::get('/dashboard/items/{category}', [ItemController::class, 'getItems'])->name('dashboard.items');
    Route::get('/item/create/{category}', [ItemController::class, 'create'])->name('item.create');
    Route::get('/item/{item}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::get('/dashboard/{user}/orders', [OrderController::class, 'userOrders'])->name('orders.user');
    Route::get('/users/order', [OrderController::class, 'usersOrder'])->name('users.order');
    Route::get('/admin/profile/edit', [AuthController::class, 'editProfileAdmin'])->name('admin.profile.edit');
    Route::get('/admin/search', [ItemController::class, 'adminSearch'])->name('admin.items.search');
});


Route::middleware(['auth', 'verified', 'lang', 'check-role:user'])->group(function () {
    Route::post('/home/{item}/add', [CardController::class, 'add'])->name('card.add');
    Route::delete('/home/{item}/remove', [CardController::class, 'remove'])->name('card.remove');
    Route::post('/home/order', [OrderController::class, 'order'])->name('order.card');
    Route::post('/home/contact-us', [ContactController::class, 'sendFromUser'])->name('contact.send');
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    Route::get('/home/{category}/items', [ItemController::class, 'getItemsHome'])->name('home.items');
    Route::get('/home/contact-us', [ContactController::class, 'showContactForm'])->name('contact.show');
    Route::get('/home/{item}/show', [ItemController::class, 'show'])->name('item.show');
    Route::get('/home/card', [CardController::class, 'viewCard'])->name('card.view');
    Route::get('/home/orders', [OrderController::class, 'orderView'])->name('order.view');
    Route::get('/user/profile/edit', [AuthController::class, 'editProfileUser'])->name('user.profile.edit');
    Route::get('/user/search', [ItemController::class, 'userSearch'])->name('user.items.search');
});


Route::middleware(['auth', 'verified', 'lang', 'check-role:admin,user'])->group(function () {
    Route::patch('/profile/update', [AuthController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [AuthController::class, 'destroy'])->name('profile.destroy');
    Route::post('/order/{order}/remove', [OrderController::class, 'remove'])->name('order.remove');
});





