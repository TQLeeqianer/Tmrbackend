 <?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;

/*
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function(){

    $test = '123456';
    $password  = Hash::make($test);
    return $password;
});

Route::group(['middleware'=>'guest'],function(){
    Route::get('/',[AuthController::class,'login'])->name('login');
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::get('/forget-password',[AuthController::class,'forgetPassword'])->name('forget_password');
    Route::post('/authenticate',[AuthController::class,'authenticate'])->name('authenticate');
    Route::post('/signup',[AuthController::class,'signup'])->name('signup');
});

Route::post('/logout',[AuthController::class,'logout'])->name('logout')->middleware('auth');
// Route::get('/pagination-per-page/{per_page}',[ PaginationController::class,'set_pagination_per_page'])->name('pagination_per_page');

// Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
// Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');


Route::get('/editprofile', [UserProfileController::class, 'edit'])->name('editprofile');
Route::post('/editprofile', [UserProfileController::class, 'updatePassword'])->name('updatePassword');
// Route::post('/editprofile', [UserProfileController::class, 'updatePassword'])->name('updatePassword');

// Auth::routes();
 
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
// Route::post('/updateProfile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('update.profile');

