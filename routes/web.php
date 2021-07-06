<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Frontend\IndexController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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

//admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');
//destroy method is readymade for logout
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');

Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');

Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');

Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');

Route::post('/update/change/password', [AdminProfileController::class, 'UpdateChangePassword'])->name('update.change.password');


//user routes

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');

Route::get('/', [IndexController::class, 'Index']);

Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');

Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');

Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');

Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');

Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');


//admin brand all routes

Route::prefix('brand')->group(function () {

    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');

    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');

    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');

    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');

    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
});


//category

Route::prefix('category')->group(function () {

    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');

    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');

    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');

    Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');

    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

    //subcategory
    Route::get('/sub/view', [SubcategoryController::class, 'SubcategoryView'])->name('all.subcategory');

    Route::post('/sub/store', [SubcategoryController::class, 'SubcategoryStore'])->name('subcategory.store');

    Route::get('/sub/edit/{id}', [SubcategoryController::class, 'SubcategoryEdit'])->name('subcategory.edit');

    Route::post('/sub/update', [SubcategoryController::class, 'SubcategoryUpdate'])->name('subcategory.update');

    Route::get('/sub/delete/{id}', [SubcategoryController::class, 'SubcategoryDelete'])->name('subcategory.delete');

    //sub-subcategory
    Route::get('/sub/sub/view', [SubcategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');

    Route::get('/subcategory/ajax/{category_id}', [SubcategoryController::class, 'GetSubCategory']);

    Route::post('/sub/sub/store', [SubcategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');

    Route::get('/sub/sub/edit/{id}', [SubcategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');

    Route::post('/sub/sub/update', [SubcategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');

    Route::get('/sub/sub/delete/{id}', [SubcategoryController::class, 'SubSubcategoryDelete'])->name('subsubcategory.delete');
});

//product
Route::prefix('product')->group(function () {

    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add.product');
});
