<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\frontendCartController;
use App\Http\Controllers\frontendCheckoutController;
use App\Http\Controllers\frontendUserController;
use App\Http\Controllers\Game_MediaController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('frontend.beranda');
});

Route::get('/backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth');

Route::get('login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('login', [LoginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

// Route::resource('backend.user', UserController::class)->middleware('auth');
Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');

// Menambahkan route ke KategoriController
Route::resource('backend/kategori', KategoriController::class, ['as' => 'backend'])->middleware('auth');

// Menambahkan route ke ProdukController
Route::resource('backend/produk', ProdukController::class, ['as' => 'backend'])->middleware('auth');

// Route untuk menambah foto
Route::post('foto-produk/store', [ProdukController::class, 'storeFoto'])->name('backend.foto_produk.store')->middleware('auth');
// Route untuk menghapus foto
Route::delete('foto-produk/{id}', [ProdukController::class, 'destroyFoto'])->name('backend.foto_produk.destroy')->middleware('auth');

Route::get('frontend/beranda', [BerandaController::class, 'berandaFrontend'])->name('frontend.beranda');

Route::resource('backend/genre', GenreController::class, ['as' => 'backend'])->middleware('auth');

Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser')->middleware('auth');

Route::resource('backend/game', GameController::class, ['as' => 'backend'])->middleware('auth');

Route::resource('backend/country', CountryController::class, ['as' => 'backend'])->middleware('auth');

Route::resource('backend/region', RegionController::class, ['as' => 'backend'])->middleware('auth');

// Payment adalah metode pembayaran
Route::resource('backend/payment', PaymentController::class, ['as' => 'backend'])->middleware('auth');

// Checkout adalah riwayat pembelian
Route::resource('backend/checkout', CheckoutController::class, ['as' => 'backend'])->middleware('auth');

// Cart adalah perencanaan pembelian
Route::resource('backend/cart', CartController::class, ['as' => 'backend'])->middleware('auth');

Route::post('media/upload', [Game_MediaController::class, 'upload'])->name('media.upload')->middleware('auth');
Route::delete('media/delete/{id}', [Game_MediaController::class, 'delete'])->name('media.delete')->middleware('auth');

// create frontend for game
Route::get('frontend/game/{id}', [GameController::class, 'frontendShow'])->name('frontend.game.show');

Route::resource('backend/review', ReviewController::class, ['as' => 'backend'])->middleware('auth');

Route::resource('frontend/cart', frontendCartController::class, ['as' => 'frontend'])->middleware('auth');
Route::resource('frontend/checkout', frontendCheckoutController::class, ['as' => 'frontend'])->middleware('auth');

Route::delete('/reviews/{games_id}/{users_id}', [ReviewController::class, 'destroy'])->name('review.delete')->middleware('auth');

Route::resource('frontend/user', frontendUserController::class, ['as' => 'frontend']);