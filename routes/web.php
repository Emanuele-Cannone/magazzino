<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ForcedActionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorksheetController;
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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['middleware' => ['permission:Crea Utente|Modifica Utente|Elimina Utente']], function () {
        Route::resource('users', UserController::class);
        Route::post('users/{user}', [UserController::class, 'syncRoles'])->name('syncRoles');
    });

    Route::resource('articles', ArticleController::class);
    Route::post('/articles/search',[ArticleController::class,'searchArticle'])->name('articles.search');
    Route::group(['middleware' => ['permission:Refill Articolo']], function () {
        Route::post('/articles/{article}',[ArticleController::class,'refill'])->name('articles.refill');
    });

    Route::group(['middleware' => ['permission:Crea Cliente|Modifica Cliente|Elimina Cliente']], function () {
        Route::resource('customers', CustomerController::class);
    });

    Route::group(['middleware' => ['permission:Gestione Carrello']], function () {
        Route::resource('cart', CartController::class);
    });

    Route::group(['middleware' => ['permission:Crea Gruppo|Modifica Gruppo|Elimina Gruppo']], function () {
        Route::resource('clusters', ClusterController::class);
    });

    Route::group(['middleware' => ['permission:Visualizza Ordini']], function () {
        Route::resource('orders', OrderController::class);
    });

    Route::resource('appointments', AppointmentController::class);

//    Route::resource('worksheets', WorksheetController::class);

    Route::group(['middleware' => ['permission:Crea Ruolo|Modifica Ruolo|Elimina Ruolo']], function () {
        Route::resource('roles', RoleController::class);
    });

    Route::get('actions', [ForcedActionController::class, 'index'])->name('actions');

    Route::get('report', [ReportController::class, 'index'])->name('report');
});
