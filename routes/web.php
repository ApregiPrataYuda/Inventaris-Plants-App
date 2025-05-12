<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\Auth\Auth;
use App\Http\Controllers\Employe\Employe;
use App\Http\Controllers\Error\Error;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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

Route::get('/',[Auth::class,'login_page'])->name('Auth.login');
Route::post('check-auth',[Auth::class,'Check'])->name('check.login');
Route::get('logout',[Auth::class,'Logout'])->name('logout');

Route::prefix('Admin')->name('Admin.')->group(function () {
    Route::get('Dashboard', [Admin::class, 'Dashboard'])->name('Dashboard');
});

Route::prefix('Admin')->name('Admin.')->group(function () {
    Route::get('category-plants', [Admin::class, 'plantsCategory'])->name('category.plants');
    Route::get('category-plants-get', [Admin::class, 'getDataCategory'])->name('category.plants.get');
    Route::get('category-plants-create', [Admin::class, 'CreateCategory'])->name('create.category');
    Route::post('category-plants-store', [Admin::class, 'StoreCategory'])->name('store.category');
    Route::get('view-category-update/{id}', [Admin::class, 'showCategory'])->name('category.view.updates');
    Route::put('store-update-plants-category', [Admin::class, 'UpdateCategory'])->name('update.category.management');
    Route::delete('category-delete-management/{id}', [Admin::class, 'DeleteCategory'])->name('delete.category.management');
});


Route::prefix('Admin')->name('Admin.')->group(function () {
    Route::get('location-plants', [Admin::class, 'plantsLocation'])->name('location.plants');
    Route::get('location-plants-get', [Admin::class, 'getDataLocation'])->name('location.plants.get');
    Route::get('location-plants-create', [Admin::class, 'CreateLocation'])->name('create.location');
    Route::post('location-plants-store', [Admin::class, 'StoreLocation'])->name('store.location');
    Route::get('view-location-plants-update/{id}', [Admin::class, 'showLocation'])->name('location.view.update');
    Route::put('store-update-plants-location', [Admin::class, 'UpdateLocation'])->name('update.location.management');
    Route::delete('location-delete-management/{id}', [Admin::class, 'DeleteLocation'])->name('delete.location.management');
});


//route untuk handle Administrator (User Management)
Route::get('/plants/{filename}', function ($filename) {
    $path = storage_path('app/public/plants/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    return response($file, 200)->header("Content-Type", $type);
})->name('plants.image.show');

Route::prefix('Admin')->name('Admin.')->group(function () {
    Route::get('data-plants', [Admin::class, 'plants'])->name('plants');
    Route::get('plants-get', [Admin::class, 'getDataPlants'])->name('plants.get');
    Route::get('plants-create', [Admin::class, 'CreatePlants'])->name('create.plants');
    Route::post('plants-store-data', [Admin::class, 'StorePlants'])->name('store.plants');
    Route::get('view-plants-update/{id}', [Admin::class, 'showPlants'])->name('plant.view.update.data');
    Route::put('store-update-plants', [Admin::class, 'UpdatePlants'])->name('update.plant.management');
    Route::delete('plants-delete-management/{id}', [Admin::class, 'DeletePlants'])->name('delete.plants.management');
});

Route::prefix('Admin')->name('Admin.')->group(function () {
    Route::get('log-data-plants', [Admin::class, 'LogPlants'])->name('log.plants');
    Route::get('plants-get-na', [Admin::class, 'getDataPlantsNa'])->name('plants.get.status.na');
    Route::get('plants-get-dmg', [Admin::class, 'getDataPlantsDmg'])->name('plants.get.status.dmg');
});


Route::prefix('Admin')->name('Admin.')->group(function () {
    Route::get('Report-data-plants', [Admin::class, 'ReportPlants'])->name('report.plants');
    Route::get('Report/plants/pdf', [Admin::class, 'exportPlantsPdf'])->name('report.plants.pdf');
    
});

Route::prefix('Employe')->name('Employe.')->group(function () {
Route::get('Home', [Employe::class, 'Home'])->name('home');
Route::get('data-plants', [Employe::class, 'plants'])->name('plants');
Route::get('plants-get', [Employe::class, 'getDataPlants'])->name('plants.get');
Route::get('view-plants-update/{id}', [Employe::class, 'showPlants'])->name('plant.view.update.data');
Route::put('store-update-plants', [Employe::class, 'UpdatePlants'])->name('update.plant.management');

Route::get('log-data-plants', [Employe::class, 'LogPlants'])->name('log.plants');

 Route::get('Report-data-plants', [Employe::class, 'ReportPlants'])->name('report.plants');
    Route::get('Report/plants/pdf', [Employe::class, 'exportPlantsPdf'])->name('report.plants.pdf');
});