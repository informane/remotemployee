<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LotController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect(Route('lots.index'));
});
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::resource('lots', LotController::class);
Route::get('/lots/filter/cat',[LotController::class,'filter'])->name('lots.filter');

Route::resource('categories', CategoryController::class);

//require __DIR__.'/auth.php';
