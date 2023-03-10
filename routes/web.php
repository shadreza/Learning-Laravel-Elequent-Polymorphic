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


// read
// read a photo for staff/product
Route::get('read-staff-photo/{staff_id}', function ($staff_id) {
    $staff = Staff::findOrFail($staff_id);
    foreach ($staff->photos as $photo) {
        echo $photo->path;
    }
});

Route::get('read-product-photo/{prd_id}', function ($prd_id) {
    $prd = Product::findOrFail($prd_id);
    foreach ($prd->photos as $photo) {
        echo $photo->path;
    }
});


// update
// update a photo for staff/product
Route::get('update-staff-photo/{staff_id}', function ($staff_id) {
    $staff = Staff::findOrFail($staff_id);
    $pht = Photo::where([
        ['imageable_id', $staff_id],
        ['imageable_type', 'App\Models\Staff']
    ])->first();
    $photo = $staff->photos()->whereId($pht->id)->first();
    $photo->path = 'staff' . $photo->path;
    $photo->save();
});

Route::get('update-prd-photo/{prd_id}', function ($prd_id) {
    $prd = Product::findOrFail($prd_id);
    $pht = Photo::where([
        ['imageable_id', $prd_id],
        ['imageable_type', 'App\Models\Product']
    ])->first();
    $photo = $prd->photos()->whereId($pht->id)->first();
    $photo->path = 'product' . $photo->path;
    $photo->save();
});


// delete
// delete a photo for staff/product
Route::get('delete-staff-photo/{staff_id}', function ($staff_id) {
    $staff = Staff::findOrFail($staff_id);
    $pht = Photo::where([
        ['imageable_id', $staff_id],
        ['imageable_type', 'App\Models\Staff']
    ])->first();
    $photo = $staff->photos()->whereId($pht->id)->first();
    $photo->delete();
});

Route::get('delete-prd-photo/{prd_id}', function ($prd_id) {
    $prd = Product::findOrFail($prd_id);
    $pht = Photo::where([
        ['imageable_id', $prd_id],
        ['imageable_type', 'App\Models\Product']
    ])->first();
    $photo = $prd->photos()->whereId($pht->id)->first();
    $photo->delete();
});




/*
|--------------------------------------------------------------------------
| Extra Features
|--------------------------------------------------------------------------
*/


// assign
// suppose we have a photo but not assigned to anyone
// so if we want to assign it to some one we can do that here
Route::get('assign-prd-photo/{prd_id}/{photo_id}', function ($prd_id, $photo_id) {
    $prd = Product::findOrFail($prd_id);
    $photo = Photo::findOrFail($photo_id);
    $prd->photos()->save($photo);
});


// unassign
Route::get('unassign-prd-photo/{prd_id}/{photo_id}', function ($prd_id, $photo_id) {
    $prd = Product::findOrFail($prd_id);
    $prd->photos()->whereId($photo_id)->update(['imageable_id'=>0, 'imageable_type'=>'']);
});
