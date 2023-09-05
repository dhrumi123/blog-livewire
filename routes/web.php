<?php

use App\Http\Livewire\BlogUpdate;
use App\Http\Livewire\BlogComponent;
use App\Http\Livewire\RoleComponent;
use App\Http\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\BlogViewComponent;

use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SubAdminComponent;
use App\Http\Livewire\BlogCreateComponent;
use App\Http\Livewire\PermissionComponent;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\SubCategoryComponent;
use App\Http\Controllers\DashboardController;

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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('user.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('roles', RoleComponent::class)->name('admin.role');
    Route::get('permissions', PermissionComponent::class)->name('admin.permission');
    Route::get('categories', CategoryComponent::class)->name('admin.categories');
    Route::get('subcategories', SubCategoryComponent::class)->name('admin.subcategories');
    Route::get('users', UserComponent::class)->name('admin.users');  
    Route::get('subadmins', SubAdminComponent::class)->name('admin.subadmins');  
    Route::get('blogs', BlogComponent::class)->name('admin.blogs');  
    Route::get('blog/create', BlogCreateComponent::class)->name('admin.createblog');
    Route::get('blog/{blog}/update', BlogUpdate::class)->name('admin.updateblog');

Route::get('blog/{blog}/view', BlogViewComponent::class)->name('admin.viewblog');

    Route::post('blogs/media', [BlogCreateComponent::class, 'storeMedia'])->name('blogs.storeMedia');





});

require __DIR__.'/auth.php';