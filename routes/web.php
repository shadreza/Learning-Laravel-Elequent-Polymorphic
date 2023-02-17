<?php

use Illuminate\Support\Facades\Route;
use App\Models\Staff;
use App\Models\Product;
use App\Models\Photo;

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



/*
|--------------------------------------------------------------------------
| CRUD
|--------------------------------------------------------------------------
*/


// create
// create a photo for staff/product
Route::get('create-staff-photo/{staff_id}', function ($staff_id) {
    $staff = Staff::findOrFail($staff_id);
    $staff->photos()->create(["path" => "image-" . $staff_id . ".jpg"]);
});

Route::get('create-product-photo/{prd_id}', function ($prd_id) {
    $prd = Product::findOrFail($prd_id);
    $prd->photos()->create(["path" => "image-" . $prd_id . ".jpg"]);
});
