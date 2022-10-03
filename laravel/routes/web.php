<?php

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
    return view('welcome');
});

Route::get('/iu', function(){
    return "Halo Informatika Unmul";
});

Route::redirect('/youtube', 'iu');

Route::fallback(function(){
    return "404";
});

Route::view('/hello', 'hello', ['name' => 'Tegar']);

Route::get('/hello-again', function(){
    return view('hello', ['name' => 'Tegar']);
});

Route::get('/hello-world', function(){
    return view('hello.world', ['name' => 'Tegar']);
});

Route::get('/products/{id}', function($productId){
    return "Products : ". $productId;
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function($productId, $itemId){
    return "Products : ".$productId.", Items : ".$itemId;
})->name('product.item.detail');

Route::get('/categories/{id}', function(string $categoryId){
    return "Categories : ".$categoryId;
})->where('id', '[0-9]+')->name('category.detail');

Route::get('users/{id}', function (string $userId = '404') {
    return "Users : ".$userId;
})->name('user.detail');

Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail',[
        'id' => $id
    ]);
    return "Link : ".$link;
});

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', [
        'id' => $id
    ]);
});

Route::get('/conflict/{name}', function (string $name) {
    return 'Conflict '.$name;
});

Route::get('/conflict/tegar', function () {
    return 'conflict Tegar Fitrah';
});

Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);

Route::get('/input/hello/', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello/', [\App\Http\Controllers\InputController::class, 'hello']);

Route::get('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirst']);

Route::get('/input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput']);

Route::post('/input/hello/array', [\App\Http\Controllers\InputController::class, 'arrayInput']);

Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType']);

Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);
